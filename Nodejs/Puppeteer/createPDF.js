const pupprteer = require("puppeteer");

(async () => {
    const browser = await pupprteer.launch;
    const page = await browser.newPage();
    await page.goto("https://news.ycombinator.com", {
        waitUntil: "networkidle2",
    });
    await page.pdf({
        path: "../../assets/files/hn.pdf",
        format: "A4",
    });
})();
