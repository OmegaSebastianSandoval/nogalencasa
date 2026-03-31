var videos = [];
$(document).ready(function () {
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
  function calcularvalorcarrito() {
    var total = 0;
    var cantidadtotal = 0;

    // Sumar productos normales
    $(".btn-minus").each(function () {
      var id = $(this).attr("data-id");
      var cantidad = $("#cantidad" + id).val();
      var valorunitario = $("#valorunitario" + id).val();
      var valortotal = parseInt(valorunitario) * parseInt(cantidad);
      total = parseInt(total) + parseInt(valortotal);
      cantidadtotal = parseInt(cantidadtotal) + parseInt(cantidad);
    });

    // Sumar ensaladas personalizadas
    $(".cantidad-ensalada-badge").each(function () {
      var ensaladaId = $(this).attr("id").replace("cantidad_ensalada_", "");
      var cantidadText = $(this).text();
      var cantidad = parseInt(cantidadText.match(/\d+/)[0]); // Extraer solo el número
      var valorunitario = $("#valorunitario_ensalada_" + ensaladaId).val();
      var valortotal = parseInt(valorunitario) * parseInt(cantidad);
      total = parseInt(total) + parseInt(valortotal);
      cantidadtotal = parseInt(cantidadtotal) + parseInt(cantidad);
    });

    $("#totalpagar").html("$" + addCommas(total));
    $("#pedido_productoscosto").html("$" + addCommas(total) + " COP");
    $("#totalpedido").val(total);
    console.log(total);
    if (total >= 30000) {
      $("#capturarvalortotal").attr("disabled", false);
      $("#alertamonto").addClass("d-none");
    } else {
      $("#capturarvalortotal").attr("disabled", true);
      $("#alertamonto").removeClass("d-none");
    }

    calcularenvio();
    $("#cantidad-total-items").html(cantidadtotal);

    // Ocultar/mostrar el botón flotante según si hay items
    if (cantidadtotal > 0) {
      $(".btn-carrito-flotante").removeClass("ocultar");
    } else {
      $(".btn-carrito-flotante").addClass("ocultar");
    }
  }

  function calcularenvio() {
    var total = 0;
    var cantidadtotal = 0;
    var envio = $("#pedido_envio").val();
    if (!envio) {
      envio = 0;
    }

    // Sumar productos normales
    $(".btn-minus").each(function () {
      var id = $(this).attr("data-id");
      var cantidad = $("#cantidad" + id).val();
      var valorunitario = $("#valorunitario" + id).val();
      var valortotal = parseInt(valorunitario) * parseInt(cantidad);
      total = parseInt(total) + parseInt(valortotal);
      cantidadtotal = parseInt(cantidadtotal) + parseInt(cantidad);
    });

    // Sumar ensaladas personalizadas
    $(".cantidad-ensalada-badge").each(function () {
      var ensaladaId = $(this).attr("id").replace("cantidad_ensalada_", "");
      var cantidadText = $(this).text();
      var cantidad = parseInt(cantidadText.match(/\d+/)[0]); // Extraer solo el número
      var valorunitario = $("#valorunitario_ensalada_" + ensaladaId).val();
      var valortotal = parseInt(valorunitario) * parseInt(cantidad);
      total = parseInt(total) + parseInt(valortotal);
      cantidadtotal = parseInt(cantidadtotal) + parseInt(cantidad);
    });

    var valorpagar = parseInt(envio) + total;

    $("#pedido_valorpagar").html(
      "$ " + addCommas(parseInt(valorpagar)) + " COP",
    );
    $("#pedido_enviocosto").html("$ " + addCommas(parseInt(envio)) + " COP");
    $("#pedido_valorpagar1").val(parseInt(valorpagar));
  }

  $("body").on("change", "#pedido_envio", function () {
    calcularenvio();
  });

  traercarrito(0);

  // let cantidadStockP = 0;

  $("#btnMenos").on("click", function () {
    var cantidadInput = $("#cantidad_modal");
    var currentValue = parseInt(cantidadInput.val(), 10);

    // console.log(document.getElementById("producto-stock").value);

    cantidadStockP === 0
      ? (cantidadStockP = +document.getElementById("producto-stock").value)
      : (cantidadStockP = cantidadStockP);
    // console.log(cantidadStockP);

    if (currentValue > 1) {
      cantidadInput.val(currentValue - 1);
    }
  });

  $("#btnMas").on("click", function () {
    var cantidadInput = $("#cantidad_modal");
    var currentValue = parseInt(cantidadInput.val(), 10);

    // console.log(document.getElementById("producto-stock").value);

    cantidadStockP === 0
      ? (cantidadStockP = +document.getElementById("producto-stock").value)
      : (cantidadStockP = cantidadStockP);
    // console.log(cantidadStockP);
    if (currentValue + 1 <= cantidadStockP) {
      cantidadInput.val(currentValue + 1);
    }
  });

  $("body").on("click", ".additemsolo", function () {
    let id = $(this).attr("data-id");

    let cantidadModal = $("#cantidad_modal").val();
    let acomp1 = $("#acomp1_" + id).val();
    let acomp2 = $("#acomp2_" + id).val();
    let acomp3 = $("#acomp3_" + id).val();
    let termino = $("#terminos_" + id).val();
    // console.log(termino);
    !cantidadModal ? (cantidadModal = 1) : (cantidadModal = cantidadModal);
    $.post(
      "/totem/carrito/additem",
      {
        producto: id,
        cantidad: cantidadModal,
        acomp1: acomp1,
        acomp2: acomp2,
        acomp3: acomp3,
        termino: termino,
      },
      function (res) {
        // Traer carrito y abrirlo automáticamente
        traercarrito(1);
        $("#exampleModal").modal("hide");

        // Mostrar notificación de éxito
        mostrarNotificacionCarrito("Producto agregado al carrito");
      },
    );
  });

  closeModal = function () {
    $("#exampleModal").modal("hide");

    let idp = localStorage.getItem("idp");

    // console.log(idp);

    /*  url = window.location.href;
    console.log(url);
    top.location.href = `${url}&product=${idp}&modal=1`;
    location.reload(true); // true forza una recarga desde el servidor, evitando la caché */
  };

  openModal = function () {
    // console.log("abriend");
    $("#exampleModal").modal("show");
  };

  // Añade un evento click al elemento con clase "addnom"
  $("body").on("click", ".addnom", function () {
    // Muestra el modal con id "exampleModal"
    $("#exampleModal").modal("show");
    const unidadesContainer = document.getElementById("contenedor-unidades");
    unidadesContainer.style.display = "block";
    // Establece el valor inicial del campo con id "cantidad_modal" a 1
    $("#cantidad_modal").val(1);

    // Obtiene el valor$(el).fadeIn(); del atributo data-id del elemento clickeado
    id = $(this).attr("data-id");

    // console.log(id);

    // Obtiene los valores de los elementos con ids específicos
    let nombre = $("#nombre" + id).val();
    let imagen1 = $("#imagen" + id).val();
    let imagen = "/images/" + imagen1;
    let descripcion = $("#descripcion" + id).val();
    let favorito = $("#favorito" + id).val();
    let precio1 = $("#precio" + id).val();
    let cantidadstock = $("#cantidad-stock" + id).val();

    // Almacena la cantidad en stock
    cantidadStockP = cantidadstock;

    // Muestra el contenedor del iframe
    // $("#iframeContainer").show();

    // Realiza una petición POST para obtener productos relacionados
    $.post(
      "/page/productos/relacionados",
      {
        producto: id,
      },
      function (res) {
        // Coloca la respuesta en el contenedor del iframe
        $("#iframeContainer").html(res);
        eliminarClase(); // Llama a la función eliminarClase (suponiendo que está definida en otro lugar)
      },
    );

    traerAcompanamientos(id);
    traerTerminos(id);

    // Realiza una petición POST para obtener fotos del producto
    $.post(
      "/page/index/traerfotos/",
      {
        producto: id,
      },
      function (res) {
        contentFotos(res);
      },
    );

    // Formatea el precio del producto
    var precio = "$" + precio1;
    // Obtiene el valor del elemento con id específico
    var id = $("#id" + id).val();

    // Si no hay imagen, usa una imagen por defecto
    if (imagen1 == "") {
      imagen = "/corte/product.png";
    }

    // Actualiza el contenido del modal con los valores obtenidos
    document.getElementById("nombremodal").innerHTML = nombre;
    document.getElementById("nombremodal2").innerHTML = nombre;
    document.getElementById("imagenmodal").src = imagen;
    document.getElementById("descripcionmodal").innerHTML = descripcion;
    document.getElementById("btnModal").dataset.id = id;
    document.getElementById("preciomodal").innerHTML = precio;
    document.getElementById("favorito-modal").innerHTML = favorito
      ? `<i id='favmodal${id}' class="fa-solid fa-heart heart-fav" data-fav="${id}"   ></i>`
      : `<i id='favmodal${id}' class="fa-regular fa-heart heart-fav" data-fav="${id}"></i>`;

    document.getElementById("producto-stock").value = cantidadstock;
  });

  $("body").on("click", ".cargar-relacion", function () {
    $("#exampleModal").modal("show");
    let id = $(this).attr("data-id");
    traerAcompanamientos(id);
    traerTerminos(id);
    // Obtiene el contenedor donde se insertarán los acompañamientos
    const acompContainer = document.getElementById(
      "contenedor-acompanamientos",
    );
    // Limpia el contenedor antes de agregar nuevos elementos
    acompContainer.innerHTML = "";
    // Obtiene el contenedor de imágenes
    let contenedorImagenes = document.getElementById("contenedor-imagenes");

    // Limpia el contenido del contenedor de imágenes
    contenedorImagenes.innerHTML = "";
  });

  function eliminarClase() {
    // Obtener todos los elementos con la clase "cargar-relacion"
    const elementos = document.querySelectorAll(".cargar-relacion");
    elementos.forEach((element) => {
      // element.classList.add("addnom_2");
      element.classList.remove("addnom");
      element.setAttribute("data-bs-toggle", "");
      element.setAttribute("data-bs-target", "");
    });
  }
  function contentFotos(res) {
    // Obtiene el contenedor de imágenes
    let contenedorImagenes = document.getElementById("contenedor-imagenes");
    // console.log(res);

    // Limpia el contenido del contenedor de imágenes
    contenedorImagenes.innerHTML = "";

    // Crea un elemento div con la clase "row"
    let rowDiv = document.createElement("div");
    rowDiv.classList.add("row");

    // Itera sobre la respuesta para crear elementos de imagen
    res.forEach(function (element) {
      // Crea un elemento div con la clase "col-4"
      let colDiv = document.createElement("div");
      colDiv.classList.add("col-4");

      // Crea un elemento img
      let imagenElement = document.createElement("img");

      // Configura el atributo src con la ruta de la imagen del array
      imagenElement.src = "/images/" + element.fotos_productos_imagen;

      // Agrega el elemento img al elemento div "col-4"
      colDiv.appendChild(imagenElement);

      // Agrega el elemento div "col-4" al elemento div "row"
      rowDiv.appendChild(colDiv);
    });

    // Agrega el elemento div "row" al contenedor
    contenedorImagenes.appendChild(rowDiv);
  }

  function traerAcompanamientos(id) {
    $.post("/page/productos/acompanamientos", { producto: id }, function (res) {
      const acompanamientos = JSON.parse(res);
      const acompContainer = document.getElementById(
        "contenedor-acompanamientos",
      );
      acompContainer.innerHTML = "";
      $(acompContainer).fadeIn();
      const unidadesContainer = document.getElementById("contenedor-unidades");
      const fragment = document.createDocumentFragment();
      const isTotallyEmpty = Object.values(acompanamientos).every(
        (arr) => Array.isArray(arr) && arr.length === 0,
      );

      if (!isTotallyEmpty) {
        const title = document.createElement("h6");
        title.textContent = "Acompañamientos";
        title.classList.add("mt-2", "mb-2");
        fragment.appendChild(title);
        unidadesContainer.style.display = "none";
      }

      for (let i = 1; i <= 6; i++) {
        const acompList = acompanamientos[i];
        if (acompList.length > 0) {
          const container = document.createElement("div");
          container.classList.add("mt-1", "mb-2");
          container.style.display = "flex";
          container.style.alignItems = "center";
          container.style.gap = "4px";

          const label = document.createElement("span");
          label.textContent = `Acomp. ${i}:`;
          label.style.textWrap = "nowrap";

          const select = document.createElement("select");
          select.classList.add("form-select");
          select.id = `acomp${i}_${id}`;
          select.style.width = "150px";
          select.required = true;

          acompList.forEach((acompanamiento) => {
            const option = document.createElement("option");
            option.value = acompanamiento.acomp_nombre;
            option.textContent = acompanamiento.acomp_nombre;
            select.appendChild(option);
          });

          container.appendChild(label);
          container.appendChild(select);
          fragment.appendChild(container);
        }
      }

      acompContainer.appendChild(fragment);
    });
  }

  function traerTerminos(id) {
    $.post("/page/productos/terminos", { producto: id }, function (res) {
      const terminos = JSON.parse(res);
      // console.log(terminos);
      const termContainer = document.getElementById("contenedor-terminos");
      termContainer.innerHTML = "";
      const unidadesContainer = document.getElementById("contenedor-unidades");
      $(termContainer).fadeIn();
      const fragment = document.createDocumentFragment();
      if (terminos.length > 0) {
        unidadesContainer.style.display = "none";
        const title = document.createElement("h6");
        title.textContent = "Término";
        title.classList.add("mt-2", "mb-2");
        termContainer.appendChild(title);

        const container = document.createElement("div");
        container.classList.add("mt-1", "mb-2");
        container.style.display = "flex";
        container.style.alignItems = "center";

        const select = document.createElement("select");
        select.classList.add("form-select");
        select.id = `terminos_${id}`;
        select.style.width = "200px";
        select.required = true;

        // Opción por defecto
        const defaultOption = document.createElement("option");
        defaultOption.value = "";
        defaultOption.textContent = "Seleccionar término";
        select.appendChild(defaultOption);

        terminos.forEach((termino) => {
          const option = document.createElement("option");
          option.value = termino.termino_nombre;
          option.textContent = termino.termino_nombre;
          select.appendChild(option);
        });

        container.appendChild(select);
        fragment.appendChild(container);
      }

      termContainer.appendChild(fragment);
    });
  }
  // Obtener el elemento del modal
  let modal = document.getElementById("exampleModal");
  // Agregar un evento al modal cuando se cierra
  modal.addEventListener("hidden.bs.modal", function () {
    // Obtiene el contenedor donde se insertarán los acompañamientos
    const acompContainer = document.getElementById(
      "contenedor-acompanamientos",
    );

    const unidadesContainer = document.getElementById("contenedor-unidades");
    unidadesContainer.style.display = "block";

    // Limpia el contenedor antes de agregar nuevos elementos
    acompContainer.innerHTML = "";

    // Llamar a tu función al cerrar el modal
    setTimeout(() => {
      devolverClases();
      // console.log("cerrando modal");
    }, 200);
  });

  // Función que se ejecuta al cerrar el modal
  function devolverClases() {
    const elementos = document.querySelectorAll(".cargar-relacion");
    // console.log(elementos);
    // Recorrer los elementos y eliminar la clase "addnom"
    elementos.forEach((element) => {
      // element.classList.add("addnom_2");
      element.classList.add("addnom");
      element.setAttribute("data-bs-toggle", "modal");
      element.setAttribute("data-bs-target", "#exampleModal");
    });
  }

  $("body").on("click", ".additem", function () {
    var id = $(this).attr("data-id");
    var cantidad = $("#cantidad" + id).val();
    $.post(
      "/page/carrito/additem",
      { producto: id, cantidad: cantidad },
      function (res) {
        traercarrito(0);
      },
    );
  });

  $("body").on("click", ".btn-minus", function () {
    var id = $(this).attr("data-id");
    var cantidad = parseInt($("#cantidad" + id).val()) - 1;
    if (parseInt(cantidad) < 1) {
      cantidad = 1;
    }
    var valorunitario = $("#valorunitario" + id).val();
    $("#valortotal" + id).html(
      "$" + addCommas(parseInt(valorunitario) * parseInt(cantidad)),
    );
    $("#cantidad" + id).val(cantidad);
    $.post(
      "/totem/carrito/changecantidad",
      { producto: id, cantidad: cantidad },
      function (res) {
        calcularvalorcarrito();
      },
    );
  });

  $("body").on("click", ".btn-plus", function () {
    var id = $(this).attr("data-id");
    var cantidad = parseInt($("#cantidad" + id).val()) + 1;
    // console.log(cantidad);

    var max = parseInt($("#cantidad" + id).attr("max"));
    if (cantidad > max) {
      cantidad = max;
    }
    var valorunitario = $("#valorunitario" + id).val();
    $("#valortotal" + id).html(
      "$" + addCommas(parseInt(valorunitario) * parseInt(cantidad)),
    );
    $("#cantidad" + id).val(cantidad);
    $.post(
      "/totem/carrito/changecantidad",
      { producto: id, cantidad: cantidad },
      function (res) {
        calcularvalorcarrito();
      },
    );
  });

  $("body").on("click", ".btn-cerrar-carrito", function () {
    cerrarCarrito();
  });

  // Cerrar carrito al hacer clic en el overlay
  $("body").on("click", ".caja-carrito", function (e) {
    // Solo cerrar si el clic fue directamente en el contenedor (overlay)
    if (e.target === this) {
      cerrarCarrito();
    }
  });

  $("body").on("click", ".btn-eliminar-carrito", function () {
    var id = $(this).attr("data-id");
    $.post("/totem/carrito/deleteitem", { producto: id }, function (res) {
      traercarrito(1);
    });
  });

  // Función para abrir el carrito
  function abrirCarrito() {
    $(".caja-carrito").addClass("show");
    $("body").css("overflow", "hidden");
  }

  // Función para cerrar el carrito
  function cerrarCarrito() {
    $(".caja-carrito").removeClass("show");
    $("body").css("overflow", "");
  }

  function traercarrito(ver) {
    $.get("/totem/carrito", function (res) {
      $("#micarrito").html(res);
      calcularvalorcarrito();

      if (parseInt(ver) == 1) {
        abrirCarrito();
      }
    });
  }

  // Exponer funciones globalmente para otros archivos JS
  window.traercarrito = traercarrito;
  window.abrirCarrito = abrirCarrito;
  window.cerrarCarrito = cerrarCarrito;

  // Función para mostrar notificación al agregar al carrito
  function mostrarNotificacionCarrito(mensaje) {
    // Crear elemento de notificación si no existe
    if (!$("#notificacion-carrito").length) {
      $("body").append(`
        <div id="notificacion-carrito" class="notificacion-carrito">
          <i class="fas fa-check-circle"></i>
          <span class="mensaje-notificacion"></span>
        </div>
      `);
    }

    var $notificacion = $("#notificacion-carrito");
    $notificacion.find(".mensaje-notificacion").text(mensaje);
    $notificacion.addClass("show");

    // Ocultar después de 3 segundos
    setTimeout(function () {
      $notificacion.removeClass("show");
    }, 3000);
  }

  traercarrito(0);
});
