export interface TodoModel extends TodoBaseModel {
	id: string | number
	created_at?: string
	updated_at?: string
}

export interface TodoBaseModel {
	title: string
	description?: string | null
	is_completed?: boolean
}
