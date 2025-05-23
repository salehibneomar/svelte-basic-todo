import { HttpClient, objectToApiQuery } from '$lib'
import type { QueryObject } from '$lib/types/query'
const MODEL = 'todos'

export const getAllTodos = async (query: QueryObject = {} as QueryObject) => {
	return await HttpClient().get(`${MODEL}${objectToApiQuery(query)}`)
}
