<style>
    :root {
        --azul: #2C5483;
        --azuloscuro: #143c69;
        --naranja: #FD8126;
        --naranjaoscuro: #d35800;
        --gris: #8A8A8A;
        --grisclaro: #E3E3E3;
        --rojo: #DE5C5D;
        --grisoscuro: #212529;
    }

    .respuesta-placetopay {
        padding: 30px 0;
        background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
    }

    .card-respuesta {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        animation: fadeInUp 0.5s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card-header-respuesta {
        background: linear-gradient(135deg, var(--azul) 0%, var(--azuloscuro) 100%);
        color: white;
        padding: 20px;
        text-align: center;
    }

    .card-header-respuesta.success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    }

    .card-header-respuesta.warning {
        background: linear-gradient(135deg, var(--naranja) 0%, var(--naranjaoscuro) 100%);
    }

    .card-header-respuesta.error {
        background: linear-gradient(135deg, var(--rojo) 0%, #c44041 100%);
    }

    .card-header-respuesta i {
        font-size: 45px;
        margin-bottom: 8px;
        animation: bounce 1s ease-in-out;
    }

    @keyframes bounce {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-8px);
        }
    }

    .card-header-respuesta h2 {
        font-size: 22px;
        font-weight: 700;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .card-body-respuesta {
        padding: 25px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 15px;
        margin-bottom: 10px;
        border-radius: 10px;
        background: #f8f9fa;
        transition: all 0.3s ease;
    }

    .info-row:hover {
        background: var(--grisclaro);
        transform: translateX(5px);
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
    }

    .info-label {
        display: flex;
        align-items: center;
        font-weight: 600;
        color: var(--azuloscuro);
        font-size: 14px;
    }

    .info-label i {
        margin-right: 10px;
        color: var(--azul);
        font-size: 18px;
        width: 25px;
        text-align: center;
    }

    .info-value {
        font-size: 14px;
        color: var(--grisoscuro);
        font-weight: 500;
        text-align: right;
    }

    .info-value.highlight {
        font-size: 20px;
        font-weight: 700;
        color: var(--azul);
    }

    .estado-badge {
        display: inline-block;
        padding: 6px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 13px;
    }

    .estado-badge.success {
        background: #d4edda;
        color: #155724;
        border: 2px solid #28a745;
    }

    .estado-badge.warning {
        background: #fff3cd;
        color: #856404;
        border: 2px solid var(--naranja);
    }

    .estado-badge.error {
        background: #f8d7da;
        color: #721c24;
        border: 2px solid var(--rojo);
    }

    .detalle-estado {
        margin-top: 8px;
        padding: 12px;
        background: white;
        border-left: 3px solid var(--azul);
        border-radius: 6px;
        font-size: 13px;
        color: var(--gris);
    }

    .btn-volver {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 30px;
        background: var(--naranja);
        color: white;
        text-decoration: none;
        border-radius: 25px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        box-shadow: 0 3px 12px rgba(44, 84, 131, 0.3);
    }

    .btn-volver:hover {
        background: var(--azuloscuro);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(44, 84, 131, 0.4);
        text-decoration: none;
    }

    .btn-volver i {
        margin-right: 6px;
    }

    @media (max-width: 768px) {
        .respuesta-placetopay {
            padding: 20px 0;
        }

        .info-row {
            flex-direction: column;
            text-align: left;
            align-items: flex-start;
            padding: 10px 12px;
        }

        .info-value {
            text-align: left;
            margin-top: 6px;
            margin-left: 35px;
        }

        .card-body-respuesta {
            padding: 20px;
        }

        .card-header-respuesta {
            padding: 15px;
        }

        .card-header-respuesta h2 {
            font-size: 18px;
        }

        .card-header-respuesta i {
            font-size: 35px;
        }
    }
</style>

<div class="respuesta-placetopay">
    <div class="container">
        <?php if ($this->error != 1 && $this->pedido) {
            // Determinar el tipo de estado para aplicar colores
            $estadoClase = 'info';
            $iconoEstado = 'fa-info-circle';

            $estadoLower = strtolower($this->pedido->pedido_estado_texto ?? '');

            if (strpos($estadoLower, 'aprobad') !== false || strpos($estadoLower, 'exitosa') !== false || strpos($estadoLower, 'completad') !== false) {
                $estadoClase = 'success';
                $iconoEstado = 'fa-check-circle';
            } elseif (strpos($estadoLower, 'pendiente') !== false || strpos($estadoLower, 'proceso') !== false) {
                $estadoClase = 'warning';
                $iconoEstado = 'fa-clock';
            } elseif (strpos($estadoLower, 'rechazad') !== false || strpos($estadoLower, 'fallid') !== false || strpos($estadoLower, 'error') !== false) {
                $estadoClase = 'error';
                $iconoEstado = 'fa-times-circle';
            }
        ?>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card-respuesta">
                        <div class="card-header-respuesta <?php echo $estadoClase; ?>">
                            <i class="fas <?php echo $iconoEstado; ?>"></i>
                            <h2>Resultado de la transacción</h2>
                        </div>

                        <div class="card-body-respuesta">
                            <div class="info-row">
                                <div class="info-label">
                                    <i class="fas fa-receipt"></i>
                                    N° de pedido
                                </div>
                                <div class="info-value highlight">
                                    #<?php echo str_pad($this->pedido->pedido_id, 10, "0", STR_PAD_LEFT); ?>
                                </div>
                            </div>

                            <div class="info-row">
                                <div class="info-label">
                                    <i class="fas fa-calendar-alt"></i>
                                    Fecha del pedido
                                </div>
                                <div class="info-value highlight">
                                    <?php echo $this->pedido->pedido_fecha; ?>
                                </div>
                            </div>

                            <div class="info-row">
                                <div class="info-label">
                                    <i class="fas fa-dollar-sign"></i>
                                    Valor de la transacción
                                </div>
                                <div class="info-value highlight">
                                    $<?php echo number_format($this->pedido->pedido_valorpagar, 0, ',', '.'); ?>
                                </div>
                            </div>

                            <div class="info-row">
                                <div class="info-label">
                                    <i class="fas fa-info-circle"></i>
                                    Estado de la transacción
                                </div>
                                <div class="info-value">
                                    <span class="estado-badge <?php echo $estadoClase; ?>">
                                        <?php echo $this->pedido->pedido_estado_texto; ?>
                                    </span>
                                </div>
                            </div>

                            <?php if (!empty($this->pedido->pedido_estado_texto2)) { ?>
                                <div class="detalle-estado">
                                    <strong><i class="fas fa-comment-dots"></i> Detalle:</strong>
                                    <?php echo $this->pedido->pedido_estado_texto2; ?>
                                </div>
                            <?php } ?>

                            <div class="text-center">
                                <a href="/" class="btn-volver">
                                    <i class="fas fa-home"></i>
                                    Volver al inicio
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>