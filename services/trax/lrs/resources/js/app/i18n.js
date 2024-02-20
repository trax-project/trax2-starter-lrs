import I18nFactory from '@trax/classes/I18nFactory'
const appLocales = require.context('./locales', true, /[A-Za-z0-9-_,\s]+\.json$/i)
const libLocales = require.context('@trax/locales', true, /[A-Za-z0-9-_,\s]+\.json$/i)
const i18n = I18nFactory.make(appLocales, libLocales)

export default i18n

