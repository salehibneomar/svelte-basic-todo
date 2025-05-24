import { writable } from 'svelte/store'
import * as todoService from '$lib/api-services/todo-service'
import type { QueryObject } from '$lib/types/query'
import type { TodoModel } from '$lib/types/todo'

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

const create = (newTodo: TodoModel) => {
	todos.update((current) => {
		const updated = [...current]
		updated.unshift(newTodo)
		return updated
	})
}

const update = (updatedTodo: TodoModel) => {
	todos.update((current) =>
		current.map((todo) => (+todo.id === +updatedTodo.id ? updatedTodo : todo))
	)
}

const remove = (id: number | string) => {
	todos.update((current) => current.filter((todo) => +todo.id !== +id))
}

export default {
	todos,
	getAll,
	create,
	update,
	remove
}
