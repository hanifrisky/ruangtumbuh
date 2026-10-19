import puppeteer from 'puppeteer-core';
import fs from 'fs';
import path from 'path';

const outDir = path.resolve('docs/screenshots');
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

  // 1. Public Pages
  console.log('Capturing public pages...');
  await page.goto('http://127.0.0.1:8000/', { waitUntil: 'networkidle2' });
  await snap('01_landing_page.png');

  await page.goto('http://127.0.0.1:8000/login', { waitUntil: 'networkidle2' });
  await snap('02_login_page.png');

  await page.goto('http://127.0.0.1:8000/register', { waitUntil: 'networkidle2' });
  await snap('03_register_page.png');

  // 2. Admin Pages
  console.log('Capturing admin pages...');
  await page.goto('http://127.0.0.1:8000/login', { waitUntil: 'networkidle2' });
  await page.type('input[name="email"], input[name="username"]', 'admin@ruangtumbuh.com');
  await page.type('input[name="password"]', 'password');
  await Promise.all([
    page.waitForNavigation({ waitUntil: 'networkidle2' }),
    page.click('button[type="submit"]')
  ]);

  await snap('admin_01_dashboard.png');

  await page.goto('http://127.0.0.1:8000/admin/users', { waitUntil: 'networkidle2' });
  await snap('admin_02_users.png');

  await page.goto('http://127.0.0.1:8000/admin/counselors', { waitUntil: 'networkidle2' });
  await snap('admin_03_counselors.png');

  await page.goto('http://127.0.0.1:8000/admin/questions', { waitUntil: 'networkidle2' });
  await snap('admin_04_questions.png');

  await page.goto('http://127.0.0.1:8000/admin/option-groups', { waitUntil: 'networkidle2' });
  await snap('admin_05_option_groups.png');

  await page.goto('http://127.0.0.1:8000/admin/interpretations', { waitUntil: 'networkidle2' });
  await snap('admin_06_interpretations.png');

  await page.goto('http://127.0.0.1:8000/admin/tribes', { waitUntil: 'networkidle2' });
  await snap('admin_07_tribes.png');

  await page.goto('http://127.0.0.1:8000/admin/tribes/1/materials', { waitUntil: 'networkidle2' });
  await snap('admin_08_materials.png');

  await page.goto('http://127.0.0.1:8000/admin/lessons', { waitUntil: 'networkidle2' });
  await snap('admin_09_lessons.png');

  // Logout admin
  const client = await page.target().createCDPSession();
  await client.send('Network.clearBrowserCookies');

  // 3. Konselor Pages
  console.log('Capturing konselor pages...');
  await page.goto('http://127.0.0.1:8000/login', { waitUntil: 'networkidle2' });
  await page.type('input[name="email"], input[name="username"]', 'aris.saputra.fip@um.ac.id');
  await page.type('input[name="password"]', 'password');
  await Promise.all([
    page.waitForNavigation({ waitUntil: 'networkidle2' }),
    page.click('button[type="submit"]')
  ]);

  await snap('konselor_01_dashboard.png');

  await page.goto('http://127.0.0.1:8000/konselor/konseli/15/session', { waitUntil: 'networkidle2' });
  await snap('konselor_02_konseli_session.png');

  await page.goto('http://127.0.0.1:8000/konselor/konseli/15/wellbeing', { waitUntil: 'networkidle2' });
  await snap('konselor_03_konseli_wellbeing.png');

  await page.goto('http://127.0.0.1:8000/konselor/konseli/15/self-help', { waitUntil: 'networkidle2' });
  await snap('konselor_04_konseli_selfhelp.png');

  // Logout konselor
  await client.send('Network.clearBrowserCookies');

  // 4. Konseli Pages (Hanif - id 15)
  console.log('Capturing konseli pages...');
  await page.goto('http://127.0.0.1:8000/login', { waitUntil: 'networkidle2' });
  await page.type('input[name="email"], input[name="username"]', 'hanifsamsuanggarisky@gmail.com');
  await page.type('input[name="password"]', 'password');
  await Promise.all([
    page.waitForNavigation({ waitUntil: 'networkidle2' }),
    page.click('button[type="submit"]')
  ]);

  await snap('konseli_01_dashboard.png');

  await page.goto('http://127.0.0.1:8000/konseli/wellbeing', { waitUntil: 'networkidle2' });
  await snap('konseli_02_wellbeing_index.png');

  await page.goto('http://127.0.0.1:8000/konseli/counselor', { waitUntil: 'networkidle2' });
  await snap('konseli_03_counselor_select.png');

  await page.goto('http://127.0.0.1:8000/konseli/counseling', { waitUntil: 'networkidle2' });
  await snap('konseli_04_counseling_room.png');

  await page.goto('http://127.0.0.1:8000/konseli/reflection', { waitUntil: 'networkidle2' });
  await snap('konseli_05_reflection.png');

  await page.goto('http://127.0.0.1:8000/konseli/evaluation', { waitUntil: 'networkidle2' });
  await snap('konseli_06_evaluation.png');

  await page.goto('http://127.0.0.1:8000/konseli/tribe', { waitUntil: 'networkidle2' });
  await snap('konseli_07_tribe_select.png');

  await page.goto('http://127.0.0.1:8000/konseli/self-help/1', { waitUntil: 'networkidle2' });
  await snap('konseli_08_selfhelp_detail.png');

  await page.goto('http://127.0.0.1:8000/konseli/lessons', { waitUntil: 'networkidle2' });
  await snap('konseli_09_lessons.png');

  await page.goto('http://127.0.0.1:8000/konseli/profile', { waitUntil: 'networkidle2' });
  await snap('konseli_10_profile.png');

  await browser.close();
  console.log('All screenshots captured successfully!');
}

run().catch(err => {
  console.error('Error during capture:', err);
  process.exit(1);
});
