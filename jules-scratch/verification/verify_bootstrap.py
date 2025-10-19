from playwright.sync_api import sync_playwright

def run(playwright):
    browser = playwright.chromium.launch()
    page = browser.new_page()

    # Log in
    page.goto("http://localhost:8000/app/login.php")
    page.fill("input[name=username]", "admin")
    page.fill("input[name=password]", "password")
    page.click("button[type=submit]")

    # Wait for the dashboard to load and take a screenshot
    page.wait_for_selector("text=Dashboard Overview")
    page.screenshot(path="jules-scratch/verification/dashboard_bootstrap.png")

    browser.close()

with sync_playwright() as playwright:
    run(playwright)
