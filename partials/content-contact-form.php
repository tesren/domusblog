<div class="row contact-form">

        <div class="col-lg-6 px-2 px-lg-0">
            <img class="w-100 img-fluid mx-0 mx-lg-4" src="<?php echo get_template_directory_uri() .'/assets/images/playa.jpg';?>" alt="One Real Estate Contact">
        </div>
        
        <!--formulario-->
        <div class="col-lg-6">

            <h3 class="px-3 px-lg-5 text-center text-lg-start fs-1 mt-3 mt-lg-1 mb-2">Contacto</h3>

            <form id="v4youContactForm" action="#" class="text-start px-3 px-lg-5" method="POST" data-url="<?php echo admin_url('admin-ajax.php');?>">
                
                <div class="form-floating mb-3 mb-lg-4">
                    <input type="text" class="form-control" id="name" name="name" placeholder="nombre" required>
                    <label for="name">Nombre</label>
                </div>

                <div class="form-floating mb-3 mb-lg-4">
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                    <label for="email">Correo electrónico</label>
                </div>

                <div class="form-floating mb-3 mb-lg-4">
                    <input type="number" class="form-control" id="phone" name="phone" placeholder="322 555 5555" required>
                    <label for="phone">Teléfono</label>
                </div>

                <div class="form-floating mb-3 mb-lg-4">
                    <textarea class="form-control" placeholder="Mensaje" id="message" name="message" style="height: 150px" required></textarea>
                    <label for="message">Mensaje</label>
                </div>

                
                <button type="submit" class="btn btn1 w-100">Enviar mensaje</button>

            </form>
        </div>

    </div>