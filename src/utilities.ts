export const fetch: typeof window.fetch = (...args) => {
  const apiUrl = String(import.meta.env.PUBLIC_API_URL || '')

  if (apiUrl.endsWith('/')) {
    args[0] = apiUrl + args[0]
  } else {
    args[0] = `${apiUrl}/${args[0]}`
  }

  return window.fetch(...args)
}
