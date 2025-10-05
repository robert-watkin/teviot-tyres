import Auth from './Auth'
import RegLookupController from './RegLookupController'
import Settings from './Settings'

const Controllers = {
    Auth: Object.assign(Auth, Auth),
    RegLookupController: Object.assign(RegLookupController, RegLookupController),
    Settings: Object.assign(Settings, Settings),
}

export default Controllers