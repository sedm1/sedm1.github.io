// Import the functions you need from the SDKs you need
const firebase = require("firebase/app");
const firestore = require("firebase/firestore");
require("dotenv").config();

// Firebase configuration
const firebaseConfig = {
	apiKey: process.env.API_KEY,
	authDomain: process.env.AUTH_DOMAIN,
	projectId: process.env.PROJECT_ID,
	storageBucket: process.env.STORAGE_BUCKET,
	messagingSenderId: process.env.MESSAGING_SENDER_ID,
	appId: process.env.APP_ID,
};
// Initialize Firebase
const app = firebase.initializeApp(firebaseConfig);
const db = firestore.getFirestore(app);

// Firebase Function

/* -------------------------------------------- USER FUNCTION START -------------------------------------------- */
// FIREBASE CHECK EMAIL OPCCUPIED FUNCTION
async function FIREBASE_CHECK_EMAIL() {
	const getRef = firestore.collection(db, "Users");
	const querySnapshot = await firestore.getDocs(getRef);
	const list = querySnapshot.docs.map((doc) => ({
		...doc.data(),
	}));
	const result = list.map((element) => element.Email);
	return result;
}

// FIREBASE USER SIGNUP FUNCTION
async function FIREBASE_USER_SIGNUP(data) {
	const docRef = await firestore.addDoc(
		firestore.collection(db, "Users"),
		Object.assign(data, {
			CreateTimestamp: firestore.serverTimestamp(),
		})
	);

	return { signupSuccess: true };
}


// FIREBASE USER SIGNUP WITH GOOGLE FUNCTION
async function FIREBASE_USER_SIGNUP_WITH_GOOGLE(data) {
	const docRef = await firestore.addDoc(
		firestore.collection(db, "Users"),
		Object.assign(data, {
			CreateTimestamp: firestore.serverTimestamp(),
		})
	);

	return { Id: docRef.id, signupSuccess: true };
}


// FIREBASE USER SIGNIN WITH GOOGLE FUNCTION
async function FIREBASE_USER_SIGNIN_WITH_GOOGLE(data) {
	const q = firestore.query(
        firestore.collection(db, "Users"),
        firestore.where("Email", "==", data)
    );

    const querySnapshot = await firestore.getDocs(q);
    const list = querySnapshot.docs.map((doc) => ({
        Id: doc.id,
        ...doc.data(),
    }));

	const userInfo = list[0]
	delete userInfo['CreateTimestamp']
	delete userInfo['Password']
    return userInfo
}

// FIREBASE USER SIGNIN FUNCTION
async function FIREBASE_USER_SIGNIN(data) {
	const q = firestore.query(
		firestore.collection(db, "Users"),
		firestore.where("Email", "==", data)
	);

	const querySnapshot = await firestore.getDocs(q);
	const list = querySnapshot.docs.map((doc) => ({
		Id: doc.id,
		...doc.data(),
	}));

	if (Object.keys(list).length == 0) {
		return { message: "This user does not exist", signinSuccess: false };
	} else {
		const result = Object.assign(list[0], { signinSuccess: true });
		return result;
	}
}

// FIREBASE USER SIGNOUT FUNCTION
async function FIREBASE_USER_SIGNOUT(id) {
	// Delete the user's refreshToken
    await firestore.deleteDoc(firestore.doc(db, 'RefreshTokens', id));
    return { deleteTokenSuccess: true };
}

// FIREBASE SET REFRESH_TOKEN FUNCTION
async function FIREBASE_SET_REFRESH_TOKENS(data) {
	const ID = data.Token;
	const setRef = firestore.doc(db, "RefreshTokens", ID);
	firestore.setDoc(setRef, data);
	return data;
}

// FIREBASE GET USER BY ID FUNCTION
async function FIREBASE_GET_USER_BY_ID(id) {
	const docRef = firestore.doc(db, "Users", id);
	const docSnap = await firestore.getDoc(docRef);
	return docSnap.data();
}


// FIREBASE UPDATE USER PROFILE FUNCTION
async function FIREBASE_UPDATE_USER_PROFILE(id, data) {
	const updateRef = firestore.doc(db, "Users", id);
	firestore.updateDoc(
		updateRef,
		Object.assign(data, {
			UpdateTimestamp: firestore.serverTimestamp(),
		})
	);

	return new Promise((resolve, reject) => {
		firestore.onSnapshot(firestore.doc(db, "Users", id), (doc) => {
			const list = doc.data();
			delete list["CreateTimestamp"];
			delete list["UpdateTimestamp"];
			delete list["Password"];
			Object.assign(list, { updateSuccess: true });
			resolve(list);
		});
	});
}


// FIREBASE UPDATE USER PASSWORD FUNCTION
async function FIREBASE_UPDATE_USER_PASSWORD(id, data) {
	const updateRef = firestore.doc(db, "Users", id);
	firestore.updateDoc(
		updateRef,
		Object.assign(data, {
			UpdateTimestamp: firestore.serverTimestamp(),
		})
	);
	return { updateSuccess: true };
}

// DELETE OLD REFRESH_TOKEN FUNCTION
async function FIREBASE_DELETE_REFRESH_TOKENS(id) {
	await firestore.deleteDoc(firestore.doc(db, "RefreshTokens", id));
	return { deleteRefreshTokenSuccess: true };
}
/* -------------------------------------------- USER FUNCTION END -------------------------------------------- */

/* -------------------------------------------- ITEM FUNCTION START -------------------------------------------- */
// GET ITEMS FUNCTION
async function FIREBASE_GET_ITEMS(database, paramsKey, paramsValue) {
    const q = firestore.query(
        firestore.collection(db, database),
        firestore.where(paramsKey, "==", paramsValue)
    );

    const querySnapshot = await firestore.getDocs(q);
    const list = querySnapshot.docs.map((doc) => ({
        Id: doc.id,
        ...doc.data()
    }));

    return list
}

// FIND ITEM BY ID FUNCTION
async function FIREBASE_GET_ITEM_BY_ID(database, id) {
	const docRef = firestore.doc(db, database, id);
	const docSnap = await firestore.getDoc(docRef);
	return docSnap.data();
}


// ADD ITEMS FUNCTION
async function FIREBASE_ADD_ITEM(userDatabase, database, id, data) {
    // Create postID (UserId + timestamp)
    const postID = id + String(new Date().valueOf());

    // Find if ID exists or not
    const found = await find_id(userDatabase, id);

    if (!found) return { addItemSuccess: false }

    // Add item
    const setRef = firestore.doc(db, database, postID);
    firestore.setDoc(
        setRef,
        Object.assign(data, {
            CreateTimestamp: firestore.serverTimestamp(),
        })
    );
    
    // Restructured data
    delete data["CreateTimestamp"];
    delete data["UserId"];
    Object.assign(data, { Id: postID, addItemSuccess: true });

    return data;

}

// DELETE ITEM FUNCTION
async function FIREBASE_DELETE_ITEM(database, id) {
    // Find if ID exists or not
    const found = await find_id(database, id);

    if (!found) return { message: "ID does not exist.", deleteItemSuccess: false };

    await firestore.deleteDoc(firestore.doc(db, database, id));
    return { deleteItemSuccess: true };
}


// UPDATE ITEM FUNCTION
async function FIREBASE_UPDATE_ITEM(database, id, data) {
    // Find if ID exists or not
    const found = await find_id(database, id);

    if (!found) return { message: "ID does not exist.", updateItemSuccess: false };

    const updateRef = firestore.doc(db, database, id);
    await firestore.updateDoc(
        updateRef,
        Object.assign(data, {
            UpdateTimestamp: firestore.serverTimestamp(),
        })
    );

	return new Promise((resolve, reject) => {
		const unsub = firestore.onSnapshot(firestore.doc(db, database, id), (doc) => {
			const list = doc.data();
			Object.assign(list, { updateItemSuccess: true });
			resolve(list);
		});
		unsub()
	});
}

/* -------------------------------------------- ITEM FUNCTION END -------------------------------------------- */

// Find if ID exists or not
async function find_id(database, id) {
	const getRef = firestore.collection(db, database);
	const querySnapshot = await firestore.getDocs(getRef);
	const list = querySnapshot.docs.map((doc) => doc.id);

	const found = list.find((element) => element == id);

	return found;
}

function dateTime() {
	const today = new Date();
	const date =
		today.getFullYear() +
		"-" +
		(today.getMonth() + 1) +
		"-" +
		today.getDate();
	const time =
		today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
	const dateTime = date + " " + time;
	return dateTime;
}

module.exports = {
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
	FIREBASE_GET_ITEMS,
	FIREBASE_GET_ITEM_BY_ID,
	FIREBASE_ADD_ITEM,
	FIREBASE_DELETE_ITEM,
    FIREBASE_UPDATE_ITEM,
	dateTime,
};
