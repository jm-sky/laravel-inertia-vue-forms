export interface IFormData {
    id?: string
    name: string
    fields: IFormFieldDefinition[]
    created_at?: string
}

export interface IForm extends IFormData {
    id: string
}

export interface IFormFieldDefinition {
    label: string
    type: 'text' | 'boolean' | 'number' | 'date'
    required: boolean
}
