document.addEventListener('DOMContentLoaded', function() {
  // Toggle del sidebar
  const sidebarToggle = document.getElementById('sidebarToggle');
  const sidebar = document.getElementById('sidebar');
  const mainContent = document.getElementById('mainContent');
  
  sidebarToggle.addEventListener('click', function() {
      document.body.classList.toggle('sidebar-collapsed');
      
      if (window.innerWidth <= 992) {
          document.body.classList.toggle('sidebar-expanded');
      }
  });
  
  // Manejo del responsive
  function handleResize() {
      if (window.innerWidth <= 992) {
          document.body.classList.add('sidebar-collapsed');
      } else {
          document.body.classList.remove('sidebar-collapsed', 'sidebar-expanded');
      }
  }
  
  window.addEventListener('resize', handleResize);
  handleResize();
  
  // Alternar entre vista de tabla y tarjetas
  const tableViewBtn = document.getElementById('tableViewBtn');
  const cardsViewBtn = document.getElementById('cardsViewBtn');
  const tableView = document.getElementById('tableView');
  const cardsView = document.getElementById('cardsView');
  
  tableViewBtn.addEventListener('click', function() {
      this.classList.add('active');
      cardsViewBtn.classList.remove('active');
      tableView.style.display = 'block';
      cardsView.style.display = 'none';
  });
  
  cardsViewBtn.addEventListener('click', function() {
      this.classList.add('active');
      tableViewBtn.classList.remove('active');
      tableView.style.display = 'none';
      cardsView.style.display = 'flex';
  });
  
  // Ordenamiento de columnas
  document.querySelectorAll('.sortable').forEach(header => {
      header.addEventListener('click', function() {
          const icon = this.querySelector('i');
          const isAsc = this.classList.contains('asc');
          const isDesc = this.classList.contains('desc');
          
          // Resetear todos los headers
          document.querySelectorAll('.sortable').forEach(h => {
              h.classList.remove('asc', 'desc');
              const i = h.querySelector('i');
              i.classList.remove('fa-sort-up', 'fa-sort-down');
              i.classList.add('fa-sort');
          });
          
          // Aplicar nuevo estado
          if (!isAsc && !isDesc) {
              this.classList.add('asc');
              icon.classList.remove('fa-sort');
              icon.classList.add('fa-sort-up');
          } else if (isAsc) {
              this.classList.remove('asc');
              this.classList.add('desc');
              icon.classList.remove('fa-sort-up');
              icon.classList.add('fa-sort-down');
          } else {
              icon.classList.remove('fa-sort-down');
              icon.classList.add('fa-sort');
          }
          
          // Aquí iría la lógica real para ordenar los datos
          console.log(`Ordenar por ${this.textContent.trim()} ${this.classList.contains('asc') ? 'ASC' : 'DESC'}`);
      });
  });
  
  // Guardar nuevo programa
  document.getElementById('saveProgramBtn').addEventListener('click', function() {
      const form = document.getElementById('programForm');
      let isValid = true;
      
      // Validación simple
      form.querySelectorAll('[required]').forEach(input => {
          if (!input.value.trim()) {
              input.classList.add('is-invalid');
              isValid = false;
          } else {
              input.classList.remove('is-invalid');
          }
      });
      
      if (isValid) {
          // Simular envío
          console.log('Programa guardado:', {
              code: document.getElementById('programCode').value,
              name: document.getElementById('programName').value,
              startDate: document.getElementById('startDate').value,
              endDate: document.getElementById('endDate').value,
              status: document.getElementById('programStatus').value,
              description: document.getElementById('programDescription').value
          });
          
          // Cerrar modal
          bootstrap.Modal.getInstance(document.getElementById('newProgramModal')).hide();
          
          // Mostrar notificación
          alert('Programa creado exitosamente');
          
          // Limpiar formulario
          form.reset();
      }
  });
  
  // Filas clickeables
  document.querySelectorAll('.clickable-row').forEach(row => {
      row.addEventListener('click', function(e) {
          // Evitar que se active al hacer clic en los dropdowns
          if (!e.target.closest('.dropdown, .dropdown *')) {
              console.log('Ver detalles del programa:', this.querySelector('td:nth-child(2)').textContent);
              // Aquí podrías abrir un modal o redirigir a una página de detalles
          }
      });
  });
  
  // Aplicar filtros
  document.getElementById('applyFilters').addEventListener('click', function() {
      const filters = {
          search: document.getElementById('searchInput').value,
          status: document.getElementById('statusFilter').value,
          date: document.getElementById('dateFilter').value,
          itemsPerPage: document.getElementById('itemsPerPage').value
      };
      
      console.log('Aplicando filtros:', filters);
      // Aquí iría la lógica para filtrar los datos
  });
});