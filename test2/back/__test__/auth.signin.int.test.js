const request = require('supertest')
const app = require('../server')

jest.setTimeout(30000)

function makeEmail(suffix = '') {
  const unique = Date.now() + Math.floor(Math.random() * 100000)
  return `signinuser_${unique}${suffix}@example.com`
}

const testName = 'SigninUser'
const validPassword = 'Signin1234'

async function signupUser(email, password = validPassword) {
  const res = await request(app)
    .post('/auth/signup')
    .send({
      Email: email,
      Name: testName,
      Password: password
    })

  return res
}

describe('Тесты авторизации /auth/signin', () => {
  test('Успешный вход после авторизации', async () => {
    const email = makeEmail('_success')

    const signupRes = await signupUser(email)
    expect(signupRes.statusCode).toBe(200)
    expect(signupRes.body.signupSuccess).toBe(true)

    const signinRes = await request(app)
      .post('/auth/signin')
      .send({
        Email: email,
        Password: validPassword
      })

    expect(signinRes.statusCode).toBe(200)
    expect(signinRes.body.signinSuccess).toBe(true)
    expect(signinRes.body.Email).toBe(email)
    expect(signinRes.body.Name).toBeDefined()
    expect(signinRes.body.AccessToken).toBeDefined()
    expect(signinRes.body.RefreshToken).toBeDefined()
  })

  test('Неверный пароль при авторизации', async () => {
    const email = makeEmail('_wrong_password')

    const signupRes = await signupUser(email)
    expect(signupRes.statusCode).toBe(200)
    expect(signupRes.body.signupSuccess).toBe(true)

    const signinRes = await request(app)
      .post('/auth/signin')
      .send({
        Email: email,
        Password: 'АХАХАХАХАХАХАХАХАХАХА'
      })

    expect(signinRes.statusCode).toBe(400)
    expect(signinRes.body.signinSuccess).toBe(false)
  })

  test('Несуществующий email', async () => {
    const email = makeEmail('_not_exists')

    const signinRes = await request(app)
      .post('/auth/signin')
      .send({
        Email: email,
        Password: validPassword
      })

    expect(signinRes.statusCode).toBe(400)
    expect(signinRes.body.signinSuccess).toBe(false)
  })
})
