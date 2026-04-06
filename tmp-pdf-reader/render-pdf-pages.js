const fs = require("fs");
const path = require("path");
const { createCanvas } = require("@napi-rs/canvas");
const { getDocument } = require("pdfjs-dist/legacy/build/pdf.mjs");

class NodeCanvasFactory {
  create(width, height) {
    const canvas = createCanvas(Math.ceil(width), Math.ceil(height));
    const context = canvas.getContext("2d");

    return { canvas, context };
  }

  reset(canvasAndContext, width, height) {
    canvasAndContext.canvas.width = Math.ceil(width);
    canvasAndContext.canvas.height = Math.ceil(height);
  }

  destroy(canvasAndContext) {
    canvasAndContext.canvas.width = 0;
    canvasAndContext.canvas.height = 0;
    canvasAndContext.canvas = null;
    canvasAndContext.context = null;
  }
}

async function renderPage(pdf, pageNumber, scale, outputDir) {
  const page = await pdf.getPage(pageNumber);
  const viewport = page.getViewport({ scale });
  const canvasFactory = new NodeCanvasFactory();
  const canvasAndContext = canvasFactory.create(viewport.width, viewport.height);

  await page.render({
    canvasContext: canvasAndContext.context,
    viewport,
    canvasFactory,
  }).promise;

  const outputPath = path.join(outputDir, `page-${String(pageNumber).padStart(2, "0")}.png`);
  fs.writeFileSync(outputPath, canvasAndContext.canvas.toBuffer("image/png"));
  canvasFactory.destroy(canvasAndContext);
}

async function main() {
  const pdfPath = process.argv[2];
  const outputDir = process.argv[3];
  const scale = Number(process.argv[4] || "1.6");
  const pageList = (process.argv[5] || "")
    .split(",")
    .map((value) => Number(value.trim()))
    .filter((value) => Number.isInteger(value) && value > 0);

  if (!pdfPath || !outputDir) {
    throw new Error("Uso: node render-pdf-pages.js <pdf> <output-dir> [scale] [pages]");
  }

  fs.mkdirSync(outputDir, { recursive: true });

  const data = new Uint8Array(fs.readFileSync(pdfPath));
  const pdf = await getDocument({ data }).promise;
  const pages = pageList.length > 0
    ? pageList
    : Array.from({ length: pdf.numPages }, (_, index) => index + 1);

  for (const pageNumber of pages) {
    await renderPage(pdf, pageNumber, scale, outputDir);
  }
}

main().catch((error) => {
  console.error(error);
  process.exitCode = 1;
});
