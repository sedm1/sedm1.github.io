const request = require('supertest')
const app = require('../server')

jest.setTimeout(20000)

function makeEmail() {
  const unique = Date.now() + Math.floor(Math.random() * 100000)
  return `todo_user_${unique}@example.com`
}

const username = "TodoUser"
const password = "TodoPass123"

async function registerAndLogin() {
  const Email = makeEmail()

  await request(app)
    .post('/auth/signup')
    .send({ Email, Name: username, Password: password })

  const signinRes = await request(app)
    .post('/auth/signin')
    .send({ Email, Password: password })

  return {
    token: signinRes.body.AccessToken,
    userId: signinRes.body.Id
  }
}

describe('Интеграционные тесты TODO маршрутов', () => {
  test('Без указания токена -> 4xx оишбка', async () => {
    const res = await request(app)
      .get('/todo/all')

    expect([401, 403]).toContain(res.statusCode)
  })

  test('Успешное создание задачи', async () => {
    const user = await registerAndLogin()

    const res = await request(app)
      .post('/todo')
      .set('authorization', `Bearer ${user.token}`)
      .send({
        Content: "Новая задача",
        done: false
      })

    expect(res.statusCode).toBe(200)
    expect(res.body.addTodoSuccess).toBe(true)
    expect(res.body.Content).toBe("Новая задача")
    expect(res.body.Id).toBeDefined()
  })

  test('Создание без Content дает оишбку', async () => {
    const user = await registerAndLogin()

    const res = await request(app)
      .post('/todo')
      .set('authorization', `Bearer ${user.token}`)
      .send({
        done: false
      })

    expect(res.statusCode).toBe(400)
    expect(res.body.addTodoSuccess).toBe(false)
  })

  test('Возвращается созданная задача', async () => {
    const user = await registerAndLogin()

    await request(app)
      .post('/todo')
      .set('authorization', `Bearer ${user.token}`)
      .send({
        Content: "Задача",
        done: false
      })

    const res = await request(app)
      .get('/todo/all')
      .set('authorization', `Bearer ${user.token}`)

    expect(res.statusCode).toBe(200)
    expect(Array.isArray(res.body)).toBe(true)
    expect(res.body.length).toBe(1)
    expect(res.body[0].Content).toBe("Задача")
  })

  test('Редактировать чужую задачу нельзя', async () => {
    const owner = await registerAndLogin()
  
    const addRes = await request(app)
      .post('/todo')
      .set('authorization', `Bearer ${owner.token}`)
      .send({
        Content: "Чужая задача",
        done: false
      })
  
    const todoId = addRes.body.Id
  
    const attacker = await registerAndLogin()
  
    const updateRes = await request(app)
      .patch('/todo')
      .set('authorization', `Bearer ${attacker.token}`)
      .send({
        Id: todoId,
        Content: "Я хочу всё взломать!",
        done: true
      })
  
    expect(updateRes.statusCode).toBe(400)
    expect(updateRes.body.updateTodoSuccess).toBe(false)
  })
})
