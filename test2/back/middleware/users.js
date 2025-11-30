const bcrypt = require("bcryptjs");
const jwt = require("jsonwebtoken");
const { v4: uuidv4 } = require("uuid");
const {
	FIREBASE_CHECK_EMAIL,
	FIREBASE_USER_SIGNUP,
	FIREBASE_USER_SIGNUP_WITH_GOOGLE,
	FIREBASE_USER_SIGNIN_WITH_GOOGLE,
	FIREBASE_USER_SIGNIN,
	FIREBASE_USER_SIGNOUT,
	FIREBASE_GET_USER_BY_ID,
	FIREBASE_UPDATE_USER_PROFILE,
	FIREBASE_UPDATE_USER_PASSWORD,
	FIREBASE_SET_REFRESH_TOKENS,
	FIREBASE_DELETE_REFRESH_TOKENS,
	FIREBASE_GET_ITEM_BY_ID,
	dateTime
} = require("../config/config.js");
require("dotenv").config();


// Check email opccupied
exports.checkEmailOccupied = async (req, res) => {
	const reqData = req.body;
	const result = await FIREBASE_CHECK_EMAIL();
	const emailOccupied = result.find((element) => element == reqData.Email);
	
	if (emailOccupied != undefined) return res.send({ isEmailTaken: true });
	
	return res.send({ isEmailTaken: false});
};


// Signup
exports.signup = async (req, res) => {
	const reqData = req.body;

	if(!reqData.Email || !reqData.Name || !reqData.Password) {
		console.log(dateTime().blue, ' ', 'SIGNUP FAILE'.bold.red);
		return res.status(400).send({ message: "Users content can not be empty", signupSuccess: false });
	}

	const user = {
		Email: reqData.Email,
		Name: reqData.Name,
		Password: bcrypt.hashSync(reqData.Password, 8),
		GoogleSignIn: false
	}

	const result = await FIREBASE_USER_SIGNUP(user)

	console.log(dateTime().blue, ' ', 'SIGNUP SUCCESS'.bold.green);
	res.send(result)
}


// Signin
exports.signin = async (req, res) => {
	const reqData = req.body;
	
	// Step1: Has missing content.
	if (!reqData.Email || !reqData.Password) {
		console.log(dateTime().blue, ' ', 'SIGNIN FAILE'.bold.red);
		return res.status(400).send({
			message: "User content can not be empty.",
			signinSuccess: false,
		});
	}
	const User = {
		Email: reqData.Email,
		Password: reqData.Password,
	};

	// Step2: Confirm the existence of the email.
	const result = await FIREBASE_USER_SIGNIN(User.Email);


		// Email doesn't exists.
	if (!result.signinSuccess) {
		console.log(dateTime().blue, ' ', 'SIGNIN FAILE'.bold.red);
		return res.status(400).send({ signinSuccess: false });
	}

	const user = {
		Id: result.Id,
		Email: result.Email,
		Password: result.Password,
	};

	// Step3: Make sure the password is correct or not.
	const passwordValid = bcrypt.compareSync(reqData.Password, user.Password);
		//	Wrong password
	if (!passwordValid){
		console.log(dateTime().blue, ' ', 'SIGNIN FAILE'.bold.red);	
		return res.status(400).send({ signinSuccess: false });
	} 

	// Step4: Create accessToken & refreshToken
	const accessToken = generateJWTToken(
		{ User: user.Id },
		process.env.ACCESS_TOKEN_SECRET,
		process.env.JWT_EXPIRATION
	);
	const refreshToken = await createRefreshToken(user);
	
	// Step5: Organize and return response information.
	const userContent = {
		Id : result.Id,
		Email: result.Email,
		Name : result.Name,
		AccessToken : accessToken,
		RefreshToken : refreshToken,
		signinSuccess: true,
		GoogleSignIn: false
	}

	console.log(dateTime().blue, ' ', 'SIGNIN SUCCESS'.bold.green);	
	res.send(userContent);
}

// Signin With Google
exports.googleSignin = async (req, res) => {
	const UserInfo = req.User
	const producePassword = new Date().valueOf()

	// Confirm whether the login account exists in the database.
	const result = await FIREBASE_CHECK_EMAIL();
	const emailExists = result.find((element) => element == UserInfo.Email);

	if (emailExists != undefined){ // This account exists.

		// Signin
		const result = await FIREBASE_USER_SIGNIN_WITH_GOOGLE(UserInfo.Email)

		// Create accessToken & refreshToken
		const accessToken = generateJWTToken(
			{ User: result.Id },
			process.env.ACCESS_TOKEN_SECRET,
			process.env.JWT_EXPIRATION
		);
		const refreshToken = await createRefreshToken({ Id: result.Id });
		
		// Organize and return response information.
		const userContent = {
			Id : result.Id,
			Email: result.Email,
			Name : result.Name,
			AccessToken : accessToken,
			RefreshToken : refreshToken,
			signinSuccess: true,
			GoogleSignIn: true
		}

		console.log(dateTime().blue, ' ', 'GOOGLE SIGNIN SUCCESS'.bold.green);	
		return res.send(userContent);
		
	} else { // This account does not exist.

		// Create this user in the database. 
		const user = {
			Email: UserInfo.Email,
			Name: UserInfo.Name,
			Password: bcrypt.hashSync(String(producePassword), 8),
			GoogleSignIn: true
		}

		const result = await FIREBASE_USER_SIGNUP_WITH_GOOGLE(user)
		if(!result.signupSuccess) return console.log(dateTime().blue, ' ', 'GOOGLE SIGNIN FAILE'.bold.red)


		// Create accessToken & refreshToken
		const accessToken = generateJWTToken(
			{ User: result.Id },
			process.env.ACCESS_TOKEN_SECRET,
			process.env.JWT_EXPIRATION
		);
		const refreshToken = await createRefreshToken({ Id: result.Id });
		
		// Organize and return response information.
		const userContent = {
			Id : result.Id,
			Email: UserInfo.Email,
			Name : UserInfo.Name,
			AccessToken : accessToken,
			RefreshToken : refreshToken,
			signinSuccess: true,
			GoogleSignIn: true
		}

		console.log(dateTime().blue, ' ', 'GOOGLE SIGNIN SUCCESS'.bold.green);	
		return res.send(userContent);
		
	}
}


// Signout
exports.signout = async (req, res) => {
	// Delete the user's refreshToken
	const { RefreshToken } = req.body
	await FIREBASE_USER_SIGNOUT(RefreshToken)
	console.log(dateTime().blue, ' ', 'SIGNOUT SUCCESS'.bold.green);	
	res.send({ loggedIn: false })
}


// Update user profile 
exports.updateProfile = async (req, res) =>{
	const id = req.User
	const reqData = req.body

	if(!reqData.Email && reqData.Name == undefined)
		return res.status(400).send({ message: 'Email is required.', updateSuccess: false })
	else if(!reqData.Name && reqData.Email == undefined)
		return res.status(400).send({ message: 'Name is required.', updateSuccess: false })
	else{
		const result = await FIREBASE_UPDATE_USER_PROFILE(id, reqData)
		console.log(dateTime().blue, ' ', 'UPDATE PROFILE SUCCESS'.bold.green);
		return res.status(200).send(result)
	}
}


// Update user password
exports.updatePassword = async (req, res) => {
	const id = req.User
	const reqData = req.body

	if(!reqData.OldPassword || !reqData.NewPassword) 
		return res.status(400).send({ message: 'OldPassword and NewPassword is required.', updateSuccess: false })

	// Step1: Get user data by ID.
	const result = await FIREBASE_GET_USER_BY_ID(id);

	// Step2: Make sure the password is correct or not.
	const passwordValid = bcrypt.compareSync(reqData.OldPassword, result.Password)
	if(!passwordValid){
		console.log(dateTime().blue, ' ', 'UPDATE PASSWORD FAILE'.bold.red);	
		return res.status(400).send({ updateSuccess: false })
	}
	const modifyPassword =  bcrypt.hashSync(reqData.NewPassword, 8)
	const modifyResult = await FIREBASE_UPDATE_USER_PASSWORD(id, { Password: modifyPassword })
	console.log(dateTime().blue, ' ', 'UPDATE PASSWORD SUCCESS'.bold.green);
	return res.status(200).send({ updateSuccess: true })

}


// Reissue new access_token and new refresh_token && delete old refresh_token
exports.reissueToken = async (req, res) => {

	const refreshToken = req.body.refreshToken;

	// refreshToken is null
	if (refreshToken === "") return res.status(401).send({ message: "RefreshToken is required." });
	
	// Query whether the specified refreshtoken exists in firebase
	const result = await findRefreshToken(refreshToken);
	if (!result) return res.status(403).send({ message: "This refreshToken is invalid." });

	// Confirm whether refreshToken expires or not
	if (result.ExpiryDate < new Date().getTime()){
		console.log(dateTime().blue, ' ', 'REGENERATED TOKEN FAILE'.bold.red);	
		return res.send({ message: "This refreshToken is expired", loggedIn: false });
	}

	// Regenerate an accessToken
	const accessToken = generateJWTToken(
		{ User: result.User },
		process.env.ACCESS_TOKEN_SECRET,
		process.env.JWT_EXPIRATION
	);

	// Delete old refreshToken.
	const deleteRes = await FIREBASE_DELETE_REFRESH_TOKENS(refreshToken)

	if(!deleteRes) return res.send({ message: "System Error." })
	// Regenerate an refreshToken
	const User = { Id: result.User }
	const newRefreshToken = await createRefreshToken(User)
	
	console.log(dateTime().blue, ' ', 'REGENERATED TOKEN SUCCESS'.bold.green);
	res.send({ accessToken: accessToken, refreshToken: newRefreshToken, loggedIn: true });
};


// Generate refreshToken and store it in firebase
const createRefreshToken = async (user) => {
	const expiredAt = new Date();

	// Create expired time
	expiredAt.setSeconds(
		expiredAt.getSeconds() + parseInt(process.env.JWT_REFRESH_EXPIRATION)
	);
	const _token = uuidv4();

	const refreshToken = {
		Token: _token,
		User: user.Id,
		ExpiryDate: expiredAt.getTime(),
	};

	// Save the refresh Token related data to firestore
	FIREBASE_SET_REFRESH_TOKENS(refreshToken);
	return _token;
};


// Generate jwtToken
const generateJWTToken = (subject, privateKey, expiresTime) => {
	return jwt.sign(subject, privateKey, { expiresIn: expiresTime });
};


// Query whether the specified refreshtoken exists in firebase
const findRefreshToken = async (token) => {
	const refreshToken = token;
	const result = await FIREBASE_GET_ITEM_BY_ID("RefreshTokens", refreshToken);
	if (result == "This ID does not exist.") {
		return false;
	} else {
		return result;
	}
};