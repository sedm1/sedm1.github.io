const jwt = require("jsonwebtoken");
const { OAuth2Client } = require("google-auth-library")
require("dotenv").config();

const { TokenExpiredError } = jwt
const client = new OAuth2Client()

const catchError = (err, res) => {
    if(err.message == "jwt must be provided") 
        return res.status(401).send({ message : "Token must be provided!"})
    else if (err.message == "invalid signature")
        return res.status(401).send({ message : "Unauthorized!" })
    else if(err instanceof TokenExpiredError)
        return res.status(401).send({ message : "Token was expired!"})
    else
        return res.status(401).send({ message : "Unauthorized!" })
}

exports.verifyToken = (req, res, next) => {

    if(!req.headers.authorization) return res.status(401).send({ message : 'Token must be provided!'})

    const token  = req.headers.authorization.split(' ')[1]

    jwt.verify(token, process.env.ACCESS_TOKEN_SECRET, (err, decoded) => {
        if (err) return catchError(err, res)
        req.User = decoded.User
        next()
    })
}

exports.googleVerifyToken = async (req, res, next) => {
    const token = req.body.token
	client.setCredentials({ access_token: token })
	const userinfo = await client.request({
        url: "https://www.googleapis.com/oauth2/v3/userinfo",
	});
	req.User = {
        Email: userinfo.data.email,
        Name: userinfo.data.name,
    }
    next()
}