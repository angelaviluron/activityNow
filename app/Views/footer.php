

</div> 

<footer class="footer-personalizado text-white text-center">
  <div class="container">
    <small>
      Tecnicatura Universitaria en Web – Universidad Nacional de San Luis<br>
      Desarrollado por VILURON, Angela – 2025
    </small>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>


<script>
  document.addEventListener('DOMContentLoaded', () => {
    const labels = document.querySelectorAll('#colorSelector .color-label');

    labels.forEach(label => {
      const input = label.querySelector('input');

      if (input.checked) {
        label.classList.add('selected');
      }

      label.addEventListener('click', () => {
        labels.forEach(l => l.classList.remove('selected'));
        label.classList.add('selected');
        input.checked = true;
      });
    });
  });
</script>

</body>
</html>
