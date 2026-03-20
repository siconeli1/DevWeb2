        <?php if (($rodapeProfessor ?? false) === true): ?>
            <footer class="mt-5 border-top">
                <div style="height: 8px; background-color: #66aa33;"></div>
                <div class="py-3 text-center small" style="background-color: #66aa33; color: #000;">
                    <strong>PROF. DR. EDER PANSANI</strong><br>
                    EPANSANI@GMAIL.COM / EPANSANI@IFSP.EDU.BR
                </div>
            </footer>
        <?php else: ?>
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                <div class="col-md-4 d-flex align-items-center">
                    <a href="index.php" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                        <svg class="bi" width="30" height="24">
                            <use xlink:href="#bootstrap"></use>
                        </svg>
                    </a>
                    <span class="text-muted">&copy; Lucas Siconeli 2026</span>
                </div>
            </footer>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>
