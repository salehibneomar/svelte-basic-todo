import { HttpClient, objectToApiQuery } from '$lib'
import type { QueryObject } from '$lib/types/query'
import type { TodoBaseModel, TodoModel } from '$lib/types/todo'

const MODEL = 'todos'

export const getAllTodos = async (query: QueryObject) => {
	return await HttpClient().get(`${MODEL}${objectToApiQuery(query)}`)
}

export const createTodo = async (todo: TodoBaseModel) => {
	return await HttpClient().post(MODEL, todo)
}

export const updateTodo = async (todo: TodoModel) => {
	return await HttpClient().patch(`${MODEL}/${todo.id}`, todo)
}

export const deleteTodo = async (id: string | number) => {
	return await HttpClient().delete(`${MODEL}/${id}`)
}
