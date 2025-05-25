import { toasts } from 'svelte-toasts'
import axios from 'axios'
import type { AxiosInstance, AxiosResponse } from 'axios'

const baseURL: string = import.meta.env.VITE_API_BASE_URL as string

const allowedMethodsForSuccessToast: Record<string, true> = {
	POST: true,
	PUT: true,
	PATCH: true,
	DELETE: true
}

const HttpClient = (): AxiosInstance => {
	const instance = axios.create({
		baseURL,
		headers: {
			'Content-Type': 'application/json',
			Accept: 'application/json'
		}
	})

	instance.interceptors?.response?.use(
		(response: AxiosResponse) => {
			const METHOD: string = response.config.method?.toUpperCase() ?? ''

			if (allowedMethodsForSuccessToast[METHOD]) {
				const message = response.data?.status?.message ?? 'Request successful!'
				toasts.success(message)
			}
			return response
		},
		(error) => {
			let message = 'An error occurred!'
			if (error.response?.data?.status?.message) {
				message = error.response.data.status.message
			} else if (error.message && error.code === 'ERR_NETWORK') {
				message = 'Network error!'
			}
			toasts.error(message)
			return Promise.reject(error)
		}
	)

	return instance
}

export default HttpClient
