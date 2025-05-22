import prettierPlugin from 'eslint-plugin-prettier'
import prettierConfig from 'eslint-config-prettier'
import js from '@eslint/js'
import { includeIgnoreFile } from '@eslint/compat'
import svelte from 'eslint-plugin-svelte'
import globals from 'globals'
import { fileURLToPath } from 'node:url'
import ts from 'typescript-eslint'
import svelteConfig from './svelte.config.js'

const gitignorePath = fileURLToPath(new URL('./.gitignore', import.meta.url))

export default ts.config(
	includeIgnoreFile(gitignorePath),
	js.configs.recommended,
	...ts.configs.recommended,
	...svelte.configs.recommended,
	prettierConfig, // Ensure Prettier formatting rules override ESLint
	...svelte.configs.prettier,
	{
		languageOptions: {
			globals: { ...globals.browser, ...globals.node }
		},
		plugins: {
			prettier: prettierPlugin // Correctly include Prettier plugin as an object
		},
		rules: {
			'no-undef': 'off',
			'prettier/prettier': 'error' // Enforce Prettier formatting
		}
	},
	{
		files: ['**/*.svelte', '**/*.svelte.ts', '**/*.svelte.js'],
		languageOptions: {
			parserOptions: {
				projectService: true,
				extraFileExtensions: ['.svelte'],
				parser: ts.parser,
				svelteConfig
			}
		}
	}
)
