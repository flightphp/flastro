import { fetch } from './utilities'

interface LoggedUser {
  email: string | null
  isLogged: boolean
}

let loggedUser: LoggedUser

export async function getLoggedUser(): Promise<LoggedUser> {
  if (!loggedUser) {
    const response = await fetch('./api/auth')
    loggedUser = await response.json()
  }

  return loggedUser
}
