from playwright.sync_api import sync_playwright

def run(playwright):
    browser = playwright.chromium.launch()
    page = browser.new_page()

    # Log in
    page.goto("http://localhost:8000/login.php")
    page.fill("input[name=username]", "admin")
    page.fill("input[name=password]", "password")
    page.click("button[type=submit]")

    # Navigate to the School Info page and take a screenshot
    page.click("text=School Info")
    page.wait_for_selector("text=School Information")
    page.screenshot(path="jules-scratch/verification/school_info_page.png")

    browser.close()

with sync_playwright() as playwright:
    run(playwright)
