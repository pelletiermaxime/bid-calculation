export interface Fees {
  Basic: string
  Special: string
  Association: string
  Storage: string
}

export interface CarPrice {
  base_price: string
  fees: Fees
  total_price: string
}
