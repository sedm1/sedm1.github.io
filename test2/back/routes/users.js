module.exports = (app) => {
    const users = require('../middleware/users.js')
    const { verifyToken, googleVerifyToken } = require('../middleware/authorize')
    
    app.post('/auth/register/checkEmail', users.checkEmailOccupied)
    app.post('/auth/signup', users.signup);
    app.post('/auth/signin', users.signin)
    app.post('/auth/googleSignin', googleVerifyToken, users.googleSignin)
    app.post('/auth/signout', users.signout)
    app.post('/auth/token', users.reissueToken)
    app.post('/auth/update/profile', verifyToken, users.updateProfile)
    app.post('/auth/update/password', verifyToken, users.updatePassword)
}