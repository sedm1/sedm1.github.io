const request = require('supertest')
const app = require('../server')

jest.setTimeout(30000)

function makeEmail(suffix = '') {
  const unique = Date.now() + Math.floor(Math.random() * 100000)
  return `testuser_${unique}${suffix}@example.com`
}

const testName = 'TestUser'
const validPassword = 'Test1234'

describe('Тесты регистрации /auth/signup', () => {
  test('Регистрация нового пользователя', async () => {
    const email = makeEmail('_success')

    const res = await request(app)
      .post('/auth/signup')
      .send({
        Email: email,
        Name: testName,
        Password: validPassword
      })

    expect(res.statusCode).toBe(200)
    expect(res.body.signupSuccess).toBe(true)
  })

  test('Email занят после регистрации', async () => {
    const email = makeEmail('_check')

    const signupRes = await request(app)
      .post('/auth/signup')
      .send({
        Email: email,
        Name: testName,
        Password: validPassword
      })

    expect(signupRes.statusCode).toBe(200)
    expect(signupRes.body.signupSuccess).toBe(true)

    const checkRes = await request(app)
      .post('/auth/register/checkEmail')
      .send({ Email: email })

    expect(checkRes.statusCode).toBe(200)
    expect(checkRes.body.isEmailTaken).toBe(true)
  })

  test('Неуказание email -> ошибка', async () => {
    const res = await request(app)
      .post('/auth/signup')
      .send({
        Name: testName,
        Password: validPassword
      })

    expect(res.statusCode).toBe(400)
    expect(res.body.signupSuccess).toBe(false)
    expect(res.body.message).toBe('Users content can not be empty')
  })

  test('Регистрация без Name не проходит', async () => {
    const res = await request(app)
      .post('/auth/signup')
      .send({
        Email: makeEmail('_no_name'),
        Password: validPassword
      })

    expect(res.statusCode).toBe(400)
    expect(res.body.signupSuccess).toBe(false)
    expect(res.body.message).toBe('Users content can not be empty')
  })

  test('Ргеистарция без пароля не проходит', async () => {
    const res = await request(app)
      .post('/auth/signup')
      .send({
        Email: makeEmail('_no_password'),
        Name: testName
      })

    expect(res.statusCode).toBe(400)
    expect(res.body.signupSuccess).toBe(false)
    expect(res.body.message).toBe('Users content can not be empty')
  })
})
