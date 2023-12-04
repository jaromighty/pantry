type Styles = Record<string, string>

export const bgStyles: Styles = {
  breakfast: 'bg-orange-50',
  lunch: 'bg-blue-50',
  dinner: 'bg-pink-50',
  dessert: 'bg-red-50'
}

export const bgHoverStyles: Styles = {
  breakfast: 'bg-orange-50 hover:bg-orange-100',
  lunch: 'bg-blue-50 hover:bg-blue-100',
  dinner: 'bg-pink-50 hover:bg-pink-100',
  dessert: 'bg-red-50 hover:bg-red-100'
}

export const textStyles: Styles = {
  breakfast: 'text-orange-700',
  lunch: 'text-blue-700',
  dinner: 'text-pink-700',
  dessert: 'text-red-700'
}

export const ringStyles: Styles = {
  breakfast: 'ring-1 ring-orange-200',
  lunch: 'ring-1 ring-blue-200',
  dinner: 'ring-1 ring-pink-200',
  dessert: 'ring-1 ring-red-200'
}

export const buttonStyles: Styles = {
  breakfast: 'text-orange-500 hover:bg-orange-200',
  lunch: 'text-blue-500 hover:bg-blue-200',
  dinner: 'text-pink-500 hover:bg-pink-200',
  dessert: 'text-red-500 hover:bg-red-200'
}
