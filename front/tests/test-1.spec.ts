import { test, expect } from '@playwright/test';

test.describe('test', () => {
  test.beforeEach(async ({ page }) => {
    await page.goto('http://127.0.0.1:5173/');
  });

  test('page is working', async ({ page }) => {
    await expect(page.locator('h1')).toContainText('Car Price Calculator');

  });

  test('can calculate price', async ({ page }) => {
    await page.locator('#price').fill('1800');
    await page.locator('#type').selectOption({ label: 'Luxury' });
    await page.locator('h2').click();
    await expect(page.locator('[data-cy="base"]')).toContainText('1 800,00 $');
    await expect(page.locator('.fees ul > :nth-child(1)')).toContainText('180,00 $');
    await expect(page.locator('.fees ul > :nth-child(2)')).toContainText('72,00 $');
    await expect(page.locator('.fees ul > :nth-child(3)')).toContainText('15,00 $');
    await expect(page.locator('.fees ul > :nth-child(4)')).toContainText('100,00 $');
    await expect(page.locator('[data-cy="total"]')).toContainText('2 167,00 $');
  });

  test('can recalculate price on price change', async ({ page }) => {
    await page.fill('#price', '20000');
    await page.fill('#price', '1000000');
    await page.selectOption('#type', 'luxury');
    await expect(page.locator('h2')).toHaveText('Calculated Prices');
    await expect(page.locator('[data-cy="base"]')).toHaveText('1 000 000,00 $');
    await expect(page.locator('[data-cy="total"]')).toHaveText('1 040 320,00 $');
  });

  test('can recalculate price on type change', async ({ page }) => {
    await page.fill('#price', '1100');
    await page.selectOption('#type', 'luxury');
    await page.selectOption('#type', 'common');
    await expect(page.locator('h2')).toHaveText('Calculated Prices');
    await expect(page.locator('[data-cy="base"]')).toHaveText('1 100,00 $');
    await expect(page.locator('[data-cy="total"]')).toHaveText('1 287,00 $');
  });

  test('example test', async ({ page }) => {
    await expect(page).toHaveScreenshot();
  });
});
