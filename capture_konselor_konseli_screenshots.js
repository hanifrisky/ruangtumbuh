import puppeteer from 'puppeteer-core';
import fs from 'fs';
import path from 'path';

const baseOutDir = path.resolve('docs/screenshots');
const konselorDir = path.join(baseOutDir, 'konselor');
const konseliDir = path.join(baseOutDir, 'konseli');

if (!fs.existsSync(konselorDir)) fs.mkdirSync(konselorDir, { recursive: true });
if (!fs.existsSync(konseliDir)) fs.mkdirSync(konseliDir, { recursive: true });

const edgePath = 'C:\\Program Files (x86)\\Microsoft\\Edge\\Application\\msedge.exe';

async function run() {
  const browser = await puppeteer.launch({
    executablePath: edgePath,
    headless: 'new',
    defaultViewport: { width: 1280, height: 850 },
    args: ['--no-sandbox', '--disable-setuid-sandbox']
  });

  const page = await browser.newPage();

  async function snap(dir, filename, waitMs = 500) {
    if (waitMs > 0) await new Promise(r => setTimeout(r, waitMs));
    const dest = path.join(dir, filename);
    await page.screenshot({ path: dest, fullPage: false });
    console.log(`Saved: ${filename}`);
  }

  // ==========================================
  // 1. CAPTURE KONSELOR
  // ==========================================
  console.log('Capturing Konselor...');
  await page.goto('http://127.0.0.1:8000/login', { waitUntil: 'networkidle2' });
  await page.type('input[name="email"], input[name="username"]', 'aris.saputra.fip@um.ac.id');
  await page.type('input[name="password"]', 'password');
  await Promise.all([
    page.waitForNavigation({ waitUntil: 'networkidle2' }),
    page.click('button[type="submit"]')
  ]);

  // Konselor Dashboard
  await snap(konselorDir, 'konselor_01_dashboard.png');

  // Konselor Session: Chat
  await page.goto('http://127.0.0.1:8000/konselor/konseli/15/session', { waitUntil: 'networkidle2' });
  await snap(konselorDir, 'konselor_02_session_chat.png');

  // Konselor Session: Scroll down to schedule & evaluation
  await page.evaluate(() => window.scrollBy(0, 500));
  await snap(konselorDir, 'konselor_03_session_schedule_eval.png');

  // Konselor Wellbeing Analysis: Top summary & screening
  await page.goto('http://127.0.0.1:8000/konselor/konseli/15/wellbeing', { waitUntil: 'networkidle2' });
  await snap(konselorDir, 'konselor_04_wellbeing_summary.png');

  // Konselor Wellbeing Analysis: Dimensions breakdown
  await page.evaluate(() => window.scrollBy(0, 600));
  await snap(konselorDir, 'konselor_05_wellbeing_dimensions.png');

  // Konselor Wellbeing Analysis: Clinical protocols & suicide ideation aspects
  await page.evaluate(() => window.scrollBy(0, 600));
  await snap(konselorDir, 'konselor_06_wellbeing_protocol.png');

  // Konselor Self-Help Monitor
  await page.goto('http://127.0.0.1:8000/konselor/konseli/15/self-help', { waitUntil: 'networkidle2' });
  await snap(konselorDir, 'konselor_07_selfhelp_monitor.png');

  // Logout konselor
  const client = await page.target().createCDPSession();
  await client.send('Network.clearBrowserCookies');

  // ==========================================
  // 2. CAPTURE KONSELI
  // ==========================================
  console.log('Capturing Konseli...');
  
  // Register page
  await page.goto('http://127.0.0.1:8000/register', { waitUntil: 'networkidle2' });
  await snap(konseliDir, 'konseli_01_register.png');

  // Login page
  await page.goto('http://127.0.0.1:8000/login', { waitUntil: 'networkidle2' });
  await snap(konseliDir, 'konseli_02_login.png');

  // Login as Hanif (id 15)
  await page.type('input[name="email"], input[name="username"]', 'hanifsamsuanggarisky@gmail.com');
  await page.type('input[name="password"]', 'password');
  await Promise.all([
    page.waitForNavigation({ waitUntil: 'networkidle2' }),
    page.click('button[type="submit"]')
  ]);

  // Konseli Dashboard
  await snap(konseliDir, 'konseli_03_dashboard.png');

  // Konseli Wellbeing Index
  await page.goto('http://127.0.0.1:8000/konseli/wellbeing', { waitUntil: 'networkidle2' });
  await snap(konseliDir, 'konseli_04_wellbeing_index.png');

  // Konseli Counselor Selection
  await page.goto('http://127.0.0.1:8000/konseli/counselor', { waitUntil: 'networkidle2' });
  await snap(konseliDir, 'konseli_05_counselor_select.png');

  // Konseli Counseling Room (Chat & Meet link)
  await page.goto('http://127.0.0.1:8000/konseli/counseling', { waitUntil: 'networkidle2' });
  await snap(konseliDir, 'konseli_06_counseling_room.png');

  // Konseli Reflection Form
  await page.goto('http://127.0.0.1:8000/konseli/reflection', { waitUntil: 'networkidle2' });
  await snap(konseliDir, 'konseli_07_reflection.png');

  // Konseli Evaluation: Pre vs Post Charts & Dimensions Comparison
  await page.goto('http://127.0.0.1:8000/konseli/evaluation', { waitUntil: 'networkidle2' });
  await snap(konseliDir, 'konseli_08_evaluation_charts.png');

  // Konseli Evaluation: Scroll down to dimensions table & counselor recommendations
  await page.evaluate(() => window.scrollBy(0, 500));
  await snap(konseliDir, 'konseli_09_evaluation_details.png');

  // Konseli Tribe Selection
  await page.goto('http://127.0.0.1:8000/konseli/tribe', { waitUntil: 'networkidle2' });
  await snap(konseliDir, 'konseli_10_tribe_select.png');

  // Konseli Self-Help Detail
  await page.goto('http://127.0.0.1:8000/konseli/self-help/1', { waitUntil: 'networkidle2' });
  await snap(konseliDir, 'konseli_11_selfhelp_detail.png');

  // Konseli Lessons
  await page.goto('http://127.0.0.1:8000/konseli/lessons', { waitUntil: 'networkidle2' });
  await snap(konseliDir, 'konseli_12_lessons.png');

  // Konseli Profile
  await page.goto('http://127.0.0.1:8000/konseli/profile', { waitUntil: 'networkidle2' });
  await snap(konseliDir, 'konseli_13_profile.png');

  await browser.close();
  console.log('All detailed screenshots for Konselor and Konseli captured successfully!');
}

run().catch(err => {
  console.error('Error during capture:', err);
  process.exit(1);
});
