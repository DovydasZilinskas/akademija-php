const puppeteer = require('puppeteer');

(async () => {
  const browser = await puppeteer.launch({
    args: ['--no-sandbox', '--disable-setuid-sandbox'],
  });
  const page = await browser.newPage();
  await page.goto('http://localhost/login');
  await page.screenshot({
    path: './assets/puppet/screenshots/login.png',
  });

  await browser.close();
})();
