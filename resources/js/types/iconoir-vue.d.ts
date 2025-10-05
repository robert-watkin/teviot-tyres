declare module '@iconoir/vue' {
  import type { DefineComponent } from 'vue'
  
  // IconoirProvider component
  export const IconoirProvider: DefineComponent<{
    iconProps?: {
      strokeWidth?: number
      width?: string | number
      height?: string | number
      color?: string
    }
  }, {}, any>
  
  // Minimal type shims for the Iconoir Vue components we use
  export const Phone: DefineComponent<{}, {}, any>
  export const MapPin: DefineComponent<{}, {}, any>
  export const Tools: DefineComponent<{}, {}, any>
  export const CheckCircle: DefineComponent<{}, {}, any>
  export const Star: DefineComponent<{}, {}, any>
  export const CreditCard: DefineComponent<{}, {}, any>
  export const ArrowRight: DefineComponent<{}, {}, any>
  export const DashboardSpeed: DefineComponent<{}, {}, any>
  export const Settings: DefineComponent<{}, {}, any>
  export const Shield: DefineComponent<{}, {}, any>
}
