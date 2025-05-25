import { writable } from 'svelte/store'
import * as todoService from '$lib/api-services/todo-service'
import type { QueryObject } from '$lib/types/query'
import type { TodoBaseModel, TodoModel } from '$lib/types/todo'

const todos = writable<TodoModel[]>([])

const getAll = async (query: QueryObject = {} as QueryObject) => {
	try {
		const { data } = await todoService.getAllTodos(query)
		const { status, data: response } = data
		if (+status?.code === 200) {
			todos.set(response.data as TodoModel[])
		}
		return response
	} catch (error) {
		console.error('Error fetching todos:', error)
	}
	return null
}

const create = async (newTodo: TodoBaseModel) => {
	try {
		const { data } = await todoService.createTodo(newTodo)
		const { status, data: createdTodo } = data
		if (+status?.code === 201) {
			todos.update((current) => {
				const updated = [...current]
				updated.unshift(createdTodo as TodoModel)
				return updated
			})
		}
		return { status, createdTodo }
	} catch (error) {
		console.error('Error creating todo:', error)
	}
	return null
}

const update = (updatedTodo: TodoModel) => {
	todos.update((current) =>
		current.map((todo) => (+todo.id === +updatedTodo.id ? updatedTodo : todo))
	)
}

const remove = async (id: number | string) => {
	try {
		const { data } = await todoService.deleteTodo(id)
		const { status, data: deletedTodo } = data
		if (+status?.code === 200) {
			todos.update((current) => current.filter((todo) => +todo.id !== +id))
		}
		return { status, deletedTodo }
	} catch (error) {
		console.error('Error removing todo:', error)
	}
	return null
}

export default {
	todos,
	getAll,
	create,
	update,
	remove
}
