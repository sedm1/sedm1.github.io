export type Action = 'left' | 'right' | 'up' | 'down'
export type EmitAction = (action: Action) => void;