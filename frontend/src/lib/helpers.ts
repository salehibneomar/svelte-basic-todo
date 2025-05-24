import type { QueryObject } from './types/query'

export const objectToApiQuery = (query: QueryObject): string => {
	const params = Object.entries(query)
		.filter((entry) => entry[1] !== undefined && entry[1] !== null && entry[1] !== '')
		.map(
			([k, v]) =>
				encodeURIComponent(k) + '=' + encodeURIComponent(typeof v === 'string' ? v : String(v))
		)
		.join('&')
	return params ? `?${params}` : ''
}
