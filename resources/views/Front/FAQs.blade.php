<!DOCTYPE html>
<html lang="en" dir="ltr">
  @include('Components.head')
<body>
  <div class="container-fluid contenido">
  <!-- INICIO NAV -->
    @include('Components.header')
<!-- FIN NAV -->

    <div class="contenido texto">
      <p class="h1">Preguntas Frecuentes</p>
      <!-- INICIO PREGUNTAS FRECUENTES ACORDEON -->
      <div class="accordion" id="accordionExample">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link-faqs" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                ¿Qué tipos de eventos puedo armar?
              </button>
            </h5>
          </div>
          <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
              Podés armar cualquier tipo de evento que necesites. Ya sean fiestas de cumpleaños o casamientos, fiestas infantiles, conferencias, proyecciones... Si no encontrás tu evento en la lista, consultanos desde el botón Contacto
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
              <button class="btn btn-link-faqs collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Soy wedding planner, ¿puedo trabajar con varios eventos en simultáneo?
              </button>
            </h5>
          </div>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
              Sí, en el panel de navegación podés guardar cada evento por separado, con un nombre asignado a cada uno, y tratarlos como eventos distintos para que no tengas inconvenientes de organizar varios eventos a la vez.
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link-faqs collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                ¿Se pueden organizar los eventos en cualquier parte de Argentina?
              </button>
            </h5>
          </div>
          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="card-body">
              Por el momento, sólo te podemos ofrecer eventos en CABA y GBA. Próximamente estaremos llegando a más destinos.
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingFour">
            <h5 class="mb-0">
              <button class="btn btn-link-faqs" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                ¿Cómo es el cobro?
              </button>
            </h5>
          </div>

          <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
            <div class="card-body">
              Nos podés pagar con tarjeta de crédito mediante mercado pago (¡Consultá las promociones vigentes!), o también por Pago Mis Cuentas o transferencia bancaria. Se te debitará de tu cuenta la suma exacta por la que estás haciendo la compra.
            </div>
          </div>
        </div><div class="card">
          <div class="card-header" id="headingFive">
            <h5 class="mb-0">
              <button class="btn btn-link-faqs" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                ¿Qué servicios adicionales puedo contratar?
              </button>
            </h5>
          </div>

          <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
            <div class="card-body">
              ¡Lo que necesites! Te damos unos ejemplos, pero si lo que estás buscando no lo ves en nuestra lista, no dudes en contactarnos desde el botón Contacto. DJ, VJ, catering, decoración, animación para fiestas infantiles, grabación de video, fotografía, luces, equipos de sonidos, bola de boliche.
            </div>
          </div>
        </div><div class="card">
          <div class="card-header" id="headingSix">
            <h5 class="mb-0">
              <button class="btn btn-link-faqs" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                ¿Qué pasa si tuve una mala experiencia con el salón o con uno de los servicios?
              </button>
            </h5>
          </div>

          <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
            <div class="card-body">
              Dependiendo de cuán mala haya sido tu experiencia, podés dejar una reseña negativa, que brindará a otros usuarios más información a la hora de elegir, o sino podés escribirnos un mensaje privado y te llamaremos para que nos cuentes cuál fue el problema. Nuestro equipo te asesorará sobre la mejor manera a seguir.
            </div>
          </div>
        </div><div class="card">
          <div class="card-header" id="headingSeven">
            <h5 class="mb-0">
              <button class="btn btn-link-faqs" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                ¿Qué tipo de reservas puedo hacer?

              </button>
            </h5>
          </div>

          <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
            <div class="card-body">
              La reserva es inmediata. Una vez que pagaste una seña del 50% del valor total, el lugar o servicio quedará reservado, debiendo pagar la totalidad una semana antes del comienzo del evento.

            </div>
          </div>
        </div><div class="card">
          <div class="card-header" id="headingEight">
            <h5 class="mb-0">
              <button class="btn btn-link-faqs" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight">
                ¿Qué pasa si el local que me gustaría reservar no tiene disponibilidad para la fecha que necesito?

              </button>
            </h5>
          </div>

          <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
            <div class="card-body">
              Hay fechas que tienen más demanda que otras, por ejemplo a fin de año suele ser más difícil encontrar un lugar. ¡¡Te recomendamos que planees tu evento con tiempo para tener más chances de conseguir tu evento ideal!!
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- FIN PREGUNTAS FRECUENTES -->

    <!--Footer-->

      @include('Components.footer')

    <!--/Footer-->
  </div>


</body>
</html>
