# Node.js Express + Firebase
This application provide API for Frontend, and the connected Database is Firebase's Firestore.


___


## Prerequisites for this project
Need to create a Firebase project first and then get the configuration information for the project. You can refer to the following projects to build teaching.

[How to create and use Firebase tutorial](https://medium.com/@lewisduda46/%E7%AD%86%E8%A8%98-%E4%BD%BF%E7%94%A8node-js-express-firebase-%E5%BB%BA%E7%BD%AE%E4%B8%80%E5%80%8Brestful-api%E7%9A%84%E5%B0%88%E6%A1%88-e5a10e4de2fa)

___

## Project Features
>- Check if the email is occupied
>> API for confirming whether the email is occupied when the user registers.

>- User Signup
>> API for Signup Function.

>- User Signin
>> API for Signin Function.

>- User Login with Google
>> API for Google Login Function.

>- User Signout
>> API for Signout Function.

>- Reissue Token
>> API for Reissue accessToken and refreshToken.

>- User Update Profile
>> API for Update profile.

>- User Update Password
>> API for Update password.

>- GET user todos
>> API for user getting the TODOS.

>- POST user todo
>> API for user posting the TODOS.

>- DELETE user todo
>> API for user deleting the TODOS.

>- UPDATE user todo
>> API for user updating the TODOS.


___


## Install this project
If you need a copy of this project and run it locally on your computer please see the instructions below.


**Clone Project**

```
$ git clone https://github.com/LewisDuda/express-firebase.git
```


### Usage Packages

- [npm](https://docs.npmjs.com/)
- [express](https://www.npmjs.com/package/express)
- [bcryptjs](https://www.npmjs.com/package/bcryptjs)
- [colors](https://www.npmjs.com/package/colors)
- [cors](https://www.npmjs.com/package/cors)
- [dotenv](https://www.npmjs.com/package/dotenv)
- [firebase](https://www.npmjs.com/package/firebase)
- [google-auth-library](https://www.npmjs.com/package/google-auth-library)
- [jsonwebtoken](https://www.npmjs.com/package/jsonwebtoken)
- [nodemon(Convenient to develop Node.js)](https://www.npmjs.com/package/nodemon)
- [uuidv4](https://www.npmjs.com/package/uuidv4)


### Setup App

**1. Install npm**

```
$ npm install
```

**2. Create .env file**

```
$ touch .env
```

**3. Write your FIREBASE CONFIGURATION and TOKEN CONFIGURATION into .env file and save.**

```
// Your web app's Firebase configuration.
API_KEY = YOUR_API_KEY
AUTH_DOMAIN = YOUR_AUTH_DOMAIN
PROJECT_ID = YOUR_PROJECT_ID
STORAGE_BUCKET = YOUR_STORAGE_BUCKET
MESSAGING_SENDER_ID = YOUR_MESSAGING_SENDER_ID
APP_ID = YOUR_APP_ID

// Your token configuration.
ACCESS_TOKEN_SECRET = YOUR_ACCESS_TOKEN_SECRET
JWT_EXPIRATION = YOUR_JWT_EXPIRATION 
JWT_REFRESH_EXPIRATION = YOUR_JWT_REFRESH_EXPIRATION
```

**4. Start the App**

```
$ npm run start
```

or

```
$ npm run dev
```

**5. Finding the following message indicates the App is running successfully.**

```
Server listening on port 8888
```

___


## Related project
[Frontend Application](https://github.com/LewisDuda/vue-todo-list-login)

**Clone Project**

```
$ git clone https://github.com/LewisDuda/vue-todo-list-login.git
```

___


## Author
[Lewis](https://github.com/LewisDuda)
