import { getAllTodos } from '$lib/api-services/todo-service'

export const load = async () => {
	let todos = []

	const { data: response } = await getAllTodos()
	const { data, status } = response
	if (status?.code === 200) {
		todos = data?.data
	}

	return { todos }
}
