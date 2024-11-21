// https://on.cypress.io/api

describe('Tests', () => {
  it('page is working', () => {
    cy.visit('/')
    cy.contains('h1', 'Car Price Calculator')
  })

  it('can calculate price', () => {
    cy.visit('/')
    cy.get('#price').clear().type('1800')
    cy.get('#type').select('Luxury')
    cy.contains('h2', 'Calculated Prices')
    cy.get('[data-cy="base"]').contains('1 800,00 $')
    cy.get('.fees ul > :nth-child(1)').contains('180,00 $')
    cy.get('.fees ul > :nth-child(2)').contains('72,00 $')
    cy.get('.fees ul > :nth-child(3)').contains('15,00 $')
    cy.get('.fees ul > :nth-child(4)').contains('100,00 $')
    cy.get('[data-cy="total"]').contains('2 167,00 $')
  })


  it('can recalculate price on price change', () => {
    cy.visit('/')
    cy.get('#price').clear().type('20000')
    cy.get('#price').clear().type('1000000')
    cy.get('#type').select('Luxury')
    cy.contains('h2', 'Calculated Prices')
    cy.get('[data-cy="base"]').contains('1 000 000,00 $')
    cy.get('[data-cy="total"]').contains('1 040 320,00 $')
  })

  it('can recalculate price on type change', () => {
    cy.visit('/')
    cy.get('#price').clear().type('1100')
    cy.get('#type').select('Luxury')
    cy.get('#type').select('Common')
    cy.contains('h2', 'Calculated Prices')
    cy.get('[data-cy="base"]').contains('1 100,00 $')
    cy.get('[data-cy="total"]').contains('1 287,00 $')
  })
})
