var ensaladaConfig = null;
var ingredientesSeleccionados = [];
function addCommas(nStr) {
  nStr += "";
  x = nStr.split(".");
  x1 = x[0];
  x2 = x.length > 1 ? "." + x[1] : "";
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, "$1" + "," + "$2");
  }
  return x1 + x2;
}
function abrirModalEnsalada() {
  $.ajax({
    url: "/page/ensalada/getconfig",
    type: "GET",
    dataType: "json",
    success: function (response) {
      if (response.error) {
        alert(response.error);
        return;
      }

      ensaladaConfig = response.config;
      ingredientesSeleccionados = [];

      renderModalEnsalada(response);
      const modal = new bootstrap.Modal(
        document.getElementById("modalEnsaladaPersonalizada")
      );
      modal.show();
    },
    error: function () {
      alert("Error al cargar la configuración de la ensalada");
    },
  });
}

function renderModalEnsalada(data) {
  let html = `
        <div class="modal-header-ensalada">
            <div class="info-config-simple">
                <div class="info-item">
                    <i class="fas fa-list-ol"></i>
                    <span>Selecciona ${data.config.config_cantidad_minima} - ${
    data.config.config_cantidad_maxima
  } ingredientes</span>
                </div>
                <div class="info-item">
                    <i class="fas fa-tag"></i>
                    <span>Precio base: $${addCommas(
                      data.config.config_precio_base
                    )}</span>
                </div>
            </div>
        </div>
        <div class="modal-body-ensalada">
            <div class="row">
                <div class="col-lg-8 col-md-7 ingredientes-columna">
    `;

  // Renderizar ingredientes por categoría
  for (let categoria in data.ingredientes) {
    html += `
                    <div class="categoria-ingredientes">
                        <h4 class="titulo-categoria">${categoria}</h4>
                        <div class="row g-2 ingredientes-grid">
        `;

    data.ingredientes[categoria].forEach(function (ingrediente) {
      html += `
                        <div class="col-lg-4 col-md-6 col-sm-6 ingrediente-item">
                            <div class="ingrediente-card" data-id="${
                              ingrediente.ingrediente_id
                            }" data-precio="${ingrediente.ingrediente_precio}">
                                <div class="ingrediente-checkbox">
                                    <input type="checkbox" id="ing_${
                                      ingrediente.ingrediente_id
                                    }" value="${ingrediente.ingrediente_id}">
                                </div>
                                ${
                                  ingrediente.ingrediente_imagen
                                    ? `<img src="/images/${ingrediente.ingrediente_imagen}" alt="${ingrediente.ingrediente_nombre}">`
                                    : '<div class="sin-imagen"><i class="fas fa-leaf"></i></div>'
                                }
                                <div class="ingrediente-info">
                                    <h5>${ingrediente.ingrediente_nombre}</h5>
                                    
                                    <p class="precio-ingrediente">+ $${addCommas(
                                      ingrediente.ingrediente_precio
                                    )}</p>
                                    <p class="stock">Stock: ${
                                      ingrediente.ingrediente_stock
                                    }</p>
                                </div>
                            </div>
                        </div>
            `;
    });

    html += `
                        </div>
                    </div>
        `;
  }

  html += `
                </div>
                <div class="col-lg-4 col-md-5 resumen-columna">
                    <div class="resumen-container-sticky">
                        <div class="resumen-header">
                            <h5 class="mb-0"><i class="fas fa-clipboard-check"></i> Tu selección</h5>
                            <span class="badge-contador"><span id="contador-ingredientes">0</span>/${
                              data.config.config_cantidad_maxima
                            }</span>
                        </div>
                        
                        <div class="lista-seleccionados" id="lista-seleccionados">
                            <p class="texto-vacio"><i class="fas fa-info-circle"></i> Aún no has seleccionado ingredientes</p>
                        </div>
                        
                        <div class="resumen-precios">
                            <div class="precio-linea">
                                <span>Precio base:</span>
                                <span class="precio-valor">$${addCommas(
                                  data.config.config_precio_base
                                )}</span>
                            </div>
                            <div class="precio-linea">
                                <span>Ingredientes extras:</span>
                                <span class="precio-valor" id="precio-ingredientes">$0</span>
                            </div>
                            <div class="precio-linea precio-total">
                                <span><strong>Total:</strong></span>
                                <span class="precio-valor"><strong id="precio-total-ensalada">$${addCommas(
                                  data.config.config_precio_base
                                )}</strong></span>
                            </div>
                        </div>
                        
                        <button class="btn btn-agregar-ensalada" id="btn-agregar-ensalada" disabled>
                            <i class="fas fa-shopping-cart"></i> Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;

  $("#contenidoModalEnsalada").html(html);

  // Event listeners
  attachEnsaladaEvents();
}

function attachEnsaladaEvents() {
  // Click en card para seleccionar (excepto en el checkbox)
  $(".ingrediente-card").on("click", function (e) {
    // Si el click fue directamente en el checkbox o su label, no hacer nada
    if (
      $(e.target).is('input[type="checkbox"]') ||
      $(e.target).closest(".ingrediente-checkbox").length
    ) {
      return;
    }
    let checkbox = $(this).find('input[type="checkbox"]');
    checkbox.prop("checked", !checkbox.prop("checked"));
    toggleIngrediente($(this));
  });

  // Cambio en checkbox
  $('.ingrediente-card input[type="checkbox"]').on("change", function (e) {
    e.stopPropagation();
    toggleIngrediente($(this).closest(".ingrediente-card"));
  });

  // Botones de cantidad
  $("#btn-menos-ensalada").on("click", function () {
    let input = $("#cantidad-ensalada");
    let valor = parseInt(input.val());
    if (valor > 1) {
      input.val(valor - 1);
      actualizarPrecioTotal();
    }
  });

  $("#btn-mas-ensalada").on("click", function () {
    let input = $("#cantidad-ensalada");
    let valor = parseInt(input.val());
    input.val(valor + 1);
    actualizarPrecioTotal();
  });

  $("#cantidad-ensalada").on("change", function () {
    let valor = parseInt($(this).val());
    if (valor < 1) {
      $(this).val(1);
    }
    actualizarPrecioTotal();
  });

  // Agregar al carrito
  $("#btn-agregar-ensalada").on("click", function () {
    agregarEnsaladaAlCarrito();
  });
}

function toggleIngrediente(card) {
  let id = card.data("id");
  let nombre = card.find("h5").text();
  let precio = parseFloat(card.data("precio"));
  let checkbox = card.find('input[type="checkbox"]');
  let isChecked = checkbox.is(":checked");

  if (isChecked) {
    // Validar cantidad máxima
    if (
      ingredientesSeleccionados.length >= ensaladaConfig.config_cantidad_maxima
    ) {
      checkbox.prop("checked", false);

      // alert(
      //   `Solo puedes seleccionar máximo ${ensaladaConfig.config_cantidad_maxima} ingredientes`
      // );
      swal.fire({
        title: `Solo puedes seleccionar máximo ${ensaladaConfig.config_cantidad_maxima} ingredientes`,
        icon: "warning",
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#FD8126",
      });
      return;
    }

    card.addClass("selected");
    ingredientesSeleccionados.push({ id: id, nombre: nombre, precio: precio });
  } else {
    card.removeClass("selected");
    ingredientesSeleccionados = ingredientesSeleccionados.filter(
      (ing) => ing.id != id
    );
  }

  actualizarResumen();
}

// Función para quitar ingrediente desde la lista
function quitarIngrediente(id) {
  // Desmarcar checkbox
  $(`#ing_${id}`).prop("checked", false);

  // Quitar clase selected de la card
  $(`.ingrediente-card[data-id="${id}"]`).removeClass("selected");

  // Quitar de la lista
  ingredientesSeleccionados = ingredientesSeleccionados.filter(
    (ing) => ing.id != id
  );

  actualizarResumen();
}

function actualizarResumen() {
  let cantidad = ingredientesSeleccionados.length;
  let precioBase = parseFloat(ensaladaConfig.config_precio_base);
  let precioIngredientes = ingredientesSeleccionados.reduce(
    (sum, ing) => sum + parseFloat(ing.precio),
    0
  );
  let precioUnitario = precioBase + precioIngredientes;

  // Actualizar contador
  $("#contador-ingredientes").text(cantidad);

  // Actualizar lista de seleccionados
  let listaHTML = "";
  if (cantidad === 0) {
    listaHTML =
      '<p class="texto-vacio"><i class="fas fa-info-circle"></i> Aún no has seleccionado ingredientes</p>';
  } else {
    listaHTML = '<div class="ingredientes-lista">';
    ingredientesSeleccionados.forEach(function (ing, index) {
      listaHTML += `
        <div class="ingrediente-seleccionado" data-id="${ing.id}">
          <span class="numero">${index + 1}</span>
          <span class="nombre">${ing.nombre}</span>
          <span class="precio-item">+$${addCommas(ing.precio)}</span>
          <but class="btn-quitar" onclick="quitarIngrediente(${ing.id})">
            <i class="fas fa-times"></i>
          </but ton>
        </div>
      `;
    });
    listaHTML += "</div>";
  }
  $("#lista-seleccionados").html(listaHTML);

  // Actualizar precios
  $("#precio-ingredientes").text("$" + addCommas(precioIngredientes));
  $("#precio-total-ensalada").text("$" + addCommas(precioUnitario));

  // Validar botón agregar
  if (
    cantidad >= ensaladaConfig.config_cantidad_minima &&
    cantidad <= ensaladaConfig.config_cantidad_maxima
  ) {
    $("#btn-agregar-ensalada").prop("disabled", false);
  } else {
    $("#btn-agregar-ensalada").prop("disabled", true);
  }
}

function actualizarPrecioTotal() {
  let precioBase = parseFloat(ensaladaConfig.config_precio_base);
  let precioIngredientes = ingredientesSeleccionados.reduce(
    (sum, ing) => sum + ing.precio,
    0
  );
  let precioUnitario = precioBase + precioIngredientes;
  let cantidad = 1;

  $("#precio-total-ensalada").text(addCommas(precioUnitario * cantidad));
}

function agregarEnsaladaAlCarrito() {
  if (
    ingredientesSeleccionados.length < ensaladaConfig.config_cantidad_minima
  ) {
    alert(
      `Debes seleccionar al menos ${ensaladaConfig.config_cantidad_minima} ingredientes`
    );
    return;
  }

  let ids = ingredientesSeleccionados.map((ing) => ing.id);
  let cantidad = 1;

  $.ajax({
    url: "/page/carrito/addensalada",
    type: "POST",
    data: {
      ingredientes: JSON.stringify(ids),
      cantidad: cantidad,
    },
    dataType: "json",
    success: function (response) {
      if (response.success) {
        // *** NUEVO: Iniciar heartbeat al agregar primera ensalada ***
        iniciarHeartbeat();
        const modal = bootstrap.Modal.getInstance(
          document.getElementById("modalEnsaladaPersonalizada")
        );
        modal.hide();

        // Llamar función global traercarrito definida en main.js
        if (typeof traercarrito === "function") {
          traercarrito(0);
        }

        swal.fire({
          title: "¡Ensalada agregada al carrito!",
          icon: "success",
          confirmButtonText: "Continuar",
          confirmButtonColor: "#FD8126",
        });
      } else {
        alert(response.error || "Error al agregar la ensalada al carrito");
      }
    },
    error: function () {
      alert("Error al agregar la ensalada al carrito");
    },
  });
}

// Inicializar cuando se carga el documento
$(document).ready(function () {
  // Agregar botón para abrir modal en el lugar apropiado
  $("body").on("click", ".btn-ensalada-personalizada", function () {
    abrirModalEnsalada();
  });
});
let heartbeatInterval = null;

function iniciarHeartbeat() {
  // Enviar heartbeat cada 30 segundos para mantener reservas activas
  heartbeatInterval = setInterval(function () {
    enviarHeartbeat();
  }, 30000); // 30 segundos

  console.log("Heartbeat iniciado: señal cada 30 segundos");
}

function detenerHeartbeat() {
  if (heartbeatInterval) {
    clearInterval(heartbeatInterval);
    heartbeatInterval = null;
    console.log("Heartbeat detenido");
  }
}

function enviarHeartbeat() {
  $.ajax({
    url: "/page/carrito/heartbeat",
    type: "POST",
    dataType: "json",
    success: function (response) {
      if (response.success) {
        console.log("Heartbeat enviado:", response.timestamp);
      }
    },
    error: function () {
      console.log("Error al enviar heartbeat");
    },
  });
}

// Iniciar heartbeat cuando hay items en el carrito
$(document).ready(function () {
  // Verificar si hay items en carrito al cargar la página
  verificarCarritoYActivarHeartbeat();
});

function verificarCarritoYActivarHeartbeat() {
  // Puedes verificar si hay ensaladas en el carrito
  $.ajax({
    url: "/page/carrito/verificarcarrito", // Necesitas crear este método
    type: "GET",
    dataType: "json",
    success: function (response) {
      if (response.tiene_ensaladas) {
        iniciarHeartbeat();
      }
    },
  });
}

// Detener heartbeat cuando se completa la compra o se vacía el carrito
function onCompraCompletada() {
  detenerHeartbeat();
}
