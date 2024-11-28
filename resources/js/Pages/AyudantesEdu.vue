<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
//import Modal from '@/Components/Modal.vue';
import talableAyuEdu from  '@/Components/Tablas/TablaAyudanteEdu.vue';

</script>

<template>
  <Head title="Dashboard"/>

  <AuthenticatedLayout>
      <template #header>
          <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Ayudantes del instituto {{ $page.props.auth.user.ID_Institucion_usuario }}</h2>
      </template>

      <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-9">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex items-center ">
              <div class="w-full bg-white mx-auto p-5">
                <talableAyuEdu >
                  
                </talableAyuEdu>
              </div>
            </div>
        </div>
      </div>

    <!-- Modal ayudante-->
    <div v-if="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-70 z-50">
      <div class=" modal-container bg-white  w-full max-w-md p-6 rounded-lg shadow-lg relative">
        <!-- Botón de cierre -->
         <div>
          <h1 class="text-lg font-bold mb-4">Datos del ayudante</h1>
          <button @click="closeModal" class="absolute top-6 right-10 text-black-500 hover:text-black-700" title="cerrar formulario"> 
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" width="1em" height="1em" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" fill="currentColor" fillRule="evenodd" d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10m0-1.2a8.8 8.8 0 1 0 0-17.6a8.8 8.8 0 0 0 0 17.6m.849-8.8l3.11 3.111l-.848.849L12 12.849l-3.111 3.11l-.849-.848L11.151 12l-3.11-3.111l.848-.849L12 11.151l3.111-3.11l.849.848z"></path>
            </svg>
          </button>
         </div>
         
        <!-- Formulario ayudante-->
        <form class="text-black">
          <div class="bg-blue-900 text-white p-7 rounded-lg shadow-lg w-96">
            <div class="flex gap-2 mb-4">
              <div class="flex-1">
                <label class="block mb-1">RUT</label>
                <input type="number" oninput="if (this.value.length > 8) this.value = this.value.slice(0, 8)" placeholder="ej.12345678" class="w-full p-2 border border-gray-300 rounded" />
              </div>
              <div class="w-1/4">
                <label class="block mb-1">D.V</label>
                <input type="number" oninput="if (this.value.length > 1) this.value = this.value.slice(0, 1)" maxlength="9" placeholder="9" class="w-full p-2 border border-gray-300 rounded"/>
              </div>
            </div>
            
            <div class="mb-4">
              <label class="block mb-1">Nombre</label>
              <input type="text"placeholder="Nombre" class="w-full p-2 border border-gray-300 rounded"
              />
            </div>
            
            <div class="flex gap-2 mb-4">
              <div class="flex-1">
                <label class="block mb-1">Apellido Materno</label>
                <input type="text" placeholder="Apellido M." class="w-full p-2 border border-gray-300 rounded"
                />
              </div>
              <div class="flex-1">
                <label class="block mb-1">Apellido Paterno</label>
                <input type="text" placeholder="Apellido P." class="w-full p-2 border border-gray-300 rounded"/>
              </div>
            </div>

            <div class="mb-6">
            <fieldset>
              <label class="block mb-1">Sexo</label>
              <div class="flex items-center gap-4">
                <label class="flex items-center">
                  <input type="radio" name="sexo" value="Masculino" />
                  <span class="ml-2">Masculino</span>
                </label>
                <label class="flex items-center">
                  <input type="radio" name="sexo" value="Femenino" />
                  <span class="ml-2">Femenino</span>
                </label>
                <label class="flex items-center">
                  <input type="radio" name="sexo" value="N/A" />
                  <span class="ml-2">N/A</span>
                </label>
              </div>
              </fieldset>
            </div>
            
            <div class="mb-4">
              <label class="block mb-1">Correo</label>
              <input type="email" placeholder="ejemplo.@gmail.com" class="w-full p-2 border border-gray-300 rounded"/>
            </div>
            
            <div class="mb-4">
              <label class="block mb-1">Telefono</label>
              <input type="tel" :value="formattedPhone"  @input="onInput" oninput="if (this.value.length > 13) this.value = this.value.slice(0, 13)"  placeholder="+56 1111 1111" class="w-full p-2 border border-gray-300 rounded"/>
            </div>

            <button  @click="register"class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 rounded">
              Registrarse
            </button>
          </div>
        </form>
      </div>
    </div>
<!-- Modal ayudante-->
  </AuthenticatedLayout>
</template>

  <script>
  export default {
    name: 'Home',
    props: {
      message: String
    },
    data() {
      return {
        showModal: false,
        phoneInput: '',
        searchAyudante: "", // Término de búsqueda
      };
    },

    computed: {

      formattedPhone() {
            // Formatear el número de teléfono
            const cleaned = this.phoneInput.replace(/\D/g, ''); // Remover todos los caracteres no numéricos
            const match = cleaned.match(/^(\+?(\d{2}))?(\d{4})(\d{4})$/); // Coincidir con el patrón deseado
            if (match) {
                return `+${match[1] || ''}-${match[3]}-${match[4]}`; // Construir el formato
            }
            return this.phoneInput; // Retornar el valor original si no coincide
        },
    },

    methods: {
      alertMessage() {
        alert("Inertia y Vue están funcionando correctamente!");
      },
      openModal() {
      this.showModal = true; // Abre el modal
      },
      closeModal() {
        this.showModal = false; // Cierra el modal
      },
      register() {
      // Lógica para registrar al usuario
      alert("Registrado correctamente");
      this.closeModal(); // Cierra el modal después del registro
      },
      onInput(event) {
            // Actualizar el valor sin formato
            this.phoneInput = event.target.value;
        },
    }
  };
  </script>
  
  <style scoped>

input {
  color: #000000; /* Este es el código hexadecimal de 'text-gray-800' en Tailwind */
}

  .modal-container {
  padding: 30px; /* Ajusta el padding */
  margin-top: 40px; /* Reduce el espacio superior */
  margin-bottom: 50px; /* Reduce el espacio inferior */
  max-height: 100vh; /* Limita la altura máxima para evitar desbordamiento */
}
  </style>