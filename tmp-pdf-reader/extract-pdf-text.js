const fs = require("fs");
const path = require("path");
const { getDocument } = require("pdfjs-dist/legacy/build/pdf.mjs");

async function main() {
  const pdfPath = process.argv[2];

  if (!pdfPath) {
    throw new Error("Informe o caminho do PDF.");
  }

  const data = new Uint8Array(fs.readFileSync(pdfPath));
  const loadingTask = getDocument({ data });
  const pdf = await loadingTask.promise;
  const pages = [];

  for (let pageNumber = 1; pageNumber <= pdf.numPages; pageNumber += 1) {
    const page = await pdf.getPage(pageNumber);
    const textContent = await page.getTextContent();
    const text = textContent.items
      .map((item) => ("str" in item ? item.str : ""))
      .join(" ")
      .replace(/\s+/g, " ")
      .trim();

    pages.push({
      pageNumber,
      text,
    });
  }

  process.stdout.write(JSON.stringify({ numPages: pdf.numPages, pages }, null, 2));
}

main().catch((error) => {
  console.error(error);
  process.exitCode = 1;
});
