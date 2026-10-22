import puppeteer from 'puppeteer-core';
import fs from 'fs';
import path from 'path';

const outDir = path.resolve('docs/screenshots/admin');
if (!fs.existsSync(outDir)) {
  fs.mkdirSync(outDir, { recursive: true });
}

const edgePath = 'C:\\Program Files (x86)\\Microsoft\\Edge\\Application\\msedge.exe';

async function run() {
  const browser = await puppeteer.launch({
    executablePath: edgePath,
    headless: 'new',
    defaultViewport: { width: 1280, height: 800 },
    args: ['--no-sandbox', '--disable-setuid-sandbox']
  });

  const page = await browser.newPage();

  async function snap(filename, waitMs = 500) {
    if (waitMs > 0) await new Promise(r => setTimeout(r, waitMs));
    const dest = path.join(outDir, filename);
    await page.screenshot({ path: dest, fullPage: false });
    console.log(`Saved: ${filename}`);
  }

  // 1. Login Page
  console.log('Capturing Login...');
  await page.goto('http://127.0.0.1:8000/login', { waitUntil: 'networkidle2' });
  await snap('admin_00_login.png');

  // Authenticate Admin
  await page.type('input[name="email"], input[name="username"]', 'admin@ruangtumbuh.com');
  await page.type('input[name="password"]', 'password');
  await Promise.all([
    page.waitForNavigation({ waitUntil: 'networkidle2' }),
    page.click('button[type="submit"]')
  ]);

  // 2. Dashboard
  console.log('Capturing Dashboard...');
  await snap('admin_01_dashboard.png');

  // 3. Option Groups Index & Create
  console.log('Capturing Option Groups...');
  await page.goto('http://127.0.0.1:8000/admin/option-groups', { waitUntil: 'networkidle2' });
  await snap('admin_02_option_groups_index.png');

  await page.goto('http://127.0.0.1:8000/admin/option-groups/create', { waitUntil: 'networkidle2' });
  await snap('admin_03_option_groups_create.png');

  // 4. Questions Index & Create
  console.log('Capturing Questions...');
  await page.goto('http://127.0.0.1:8000/admin/questions', { waitUntil: 'networkidle2' });
  await snap('admin_04_questions_index.png');

  await page.goto('http://127.0.0.1:8000/admin/questions/create', { waitUntil: 'networkidle2' });
  await snap('admin_05_questions_create.png');

  // 5. Interpretations Index & Create
  console.log('Capturing Interpretations...');
  await page.goto('http://127.0.0.1:8000/admin/interpretations', { waitUntil: 'networkidle2' });
  await snap('admin_06_interpretations_index.png');

  await page.goto('http://127.0.0.1:8000/admin/interpretations/create', { waitUntil: 'networkidle2' });
  await snap('admin_07_interpretations_create.png');

  // 6. Counselors Index & Create
  console.log('Capturing Counselors...');
  await page.goto('http://127.0.0.1:8000/admin/counselors', { waitUntil: 'networkidle2' });
  await snap('admin_08_counselors_index.png');

  await page.goto('http://127.0.0.1:8000/admin/counselors/create', { waitUntil: 'networkidle2' });
  await snap('admin_09_counselors_create_account.png');
  // scroll down slightly for profile section
  await page.evaluate(() => window.scrollBy(0, 450));
  await snap('admin_10_counselors_create_profile.png');

  // 7. Tribes Index & Create
  console.log('Capturing Tribes...');
  await page.goto('http://127.0.0.1:8000/admin/tribes', { waitUntil: 'networkidle2' });
  await snap('admin_11_tribes_index.png');

  await page.goto('http://127.0.0.1:8000/admin/tribes/create', { waitUntil: 'networkidle2' });
  await snap('admin_12_tribes_create.png');

  // 8. Materials Index & Create
  console.log('Capturing Materials...');
  await page.goto('http://127.0.0.1:8000/admin/tribes/1/materials', { waitUntil: 'networkidle2' });
  await snap('admin_13_materials_index.png');

  await page.goto('http://127.0.0.1:8000/admin/tribes/1/materials/create', { waitUntil: 'networkidle2' });
  await snap('admin_14_materials_create.png');
  // scroll down to questions section
  await page.evaluate(() => window.scrollBy(0, 500));
  await snap('admin_15_materials_questions.png');

  // 9. Users Index & Edit
  console.log('Capturing Users...');
  await page.goto('http://127.0.0.1:8000/admin/users', { waitUntil: 'networkidle2' });
  await snap('admin_16_users_index.png');

  await page.goto('http://127.0.0.1:8000/admin/users/2/edit', { waitUntil: 'networkidle2' });
  await snap('admin_17_users_edit.png');

  // 10. Lessons Index & Create
  console.log('Capturing Lessons...');
  await page.goto('http://127.0.0.1:8000/admin/lessons', { waitUntil: 'networkidle2' });
  await snap('admin_18_lessons_index.png');

  await page.goto('http://127.0.0.1:8000/admin/lessons/create', { waitUntil: 'networkidle2' });
  await snap('admin_19_lessons_create.png');

  await browser.close();
  console.log('All detailed admin screenshots captured successfully!');
}

run().catch(err => {
  console.error('Error during capture:', err);
  process.exit(1);
});
