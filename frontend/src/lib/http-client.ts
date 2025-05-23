import axios from 'axios'
import type { AxiosInstance } from 'axios'

const baseURL: string = import.meta.env.VITE_API_BASE_URL as string

const HttpClient = (): AxiosInstance => {
	const instance = axios.create({
		baseURL,
		headers: {
			'Content-Type': 'application/json',
			Accept: 'application/json'
		}
	})
	return instance
}

export default HttpClient
