// @ts-check
import { defineConfig } from 'astro/config'
import { parse } from 'dotenv'
import { readFileSync } from 'node:fs'

const envFileToRead = import.meta.env.DEV ? '.env' : '.env.production'

const { BASE_HREF: base, ASTRO_BUILD_OUTDIR: outDir } = parse(
  readFileSync(envFileToRead, 'utf8')
)

console.log({ envFileReaded: envFileToRead, base })

// https://astro.build/config
export default defineConfig({
  base,
  outDir,
  build: { format: 'file' }
})
