export type Action = 'left' | 'right' | 'up' | 'down'
export type EmitAction = (action: Action) => void;

export type RecordEntry = {
    name: string;
    date: string;
    score: number;
}