import type { PageLoad } from './$types'

export const load: PageLoad = () => {
	console.log('SSR')
}

//Populate this file if you want to use SSR
//Usecase: Often, a page will need to load some data before it can be rendered. For this, we add a +page.js module that exports a load function. Reference: https://svelte.dev/docs/kit/routing
