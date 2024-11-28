<script setup>
import Modal from '@/Components/Modal.vue';
</script>

<template>
<button @click="openModal" class="rounded-md bg-blue-600 px-3 py-2 text-sm hover:bg-blue-500 font-semibold text-white space-x-3 m-1">Citar</button>

<Modal :show="showModal" @close="closeModal">
    <div class="modal-container bg-white  w-full max-w-md p-6 rounded-lg z-50 shadow-lg relative">

        <!-- Botón de cierre -->
        <div>
            <h1 class="text-lg font-bold mb-4">Citacion</h1>
            <button @click="closeModal" class="absolute rounded-lg  top-6 right-10 text-blue-900 hover:text-red-700" title="cerrar formulario"> 
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" width="1em" height="1em" viewBox="0 0 24 24" fill="2" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10m0-1.2a8.8 8.8 0 1 0 0-17.6a8.8 8.8 0 0 0 0 17.6m.849-8.8l3.11 3.111l-.848.849L12 12.849l-3.111 3.11l-.849-.848L11.151 12l-3.11-3.111l.848-.849L12 11.151l3.111-3.11l.849.848z" />
                </svg>
            </button>
        </div>
          
        <!-- Formulario para citar-->
        <form @submit.prevent="submitForm" class="text-black">
        <!-- Campo RUT -->
            <div class="flex gap-2 mb-4">
                <div class="flex-1">
                    <label class="block mb-1">RUT</label>
                    <input v-model="form.rut" type="number" oninput="if (this.value.length > 8) this.value = this.value.slice(0, 8)" placeholder="ej.12345678" class="w-full p-2 border border-gray-300 rounded" />
                </div>
                <div class="w-1/4">
                    <label class="block mb-1">D.V</label>
                    <input v-model="form.dv" type="number" oninput="if (this.value.length > 1) this.value = this.value.slice(0, 1)" placeholder="9" class="w-full p-2 border border-gray-300 rounded"/>
                </div>
            </div>

            <!-- Campo Nombre del ayudante -->
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Nombre del ayudante</label>
                <input v-model="form.nombre" type="text" placeholder="Nombre del ayudante" class="w-full p-2 border border-gray-400 rounded" />
            </div>

            <!-- Campos Apellido M y Apellido P -->
            <div class="flex space-x-4 mb-4">
                <div class="flex-1">
                <label class="block text-sm font-bold mb-2">Apellido M</label>
                <input v-model="form.apellido_materno" type="text" placeholder="Apellido M" class="w-full p-2 border border-gray-400 rounded" />
                </div>
                <div class="flex-1">
                <label class="block text-sm font-bold mb-2">Apellido P</label>
                <input v-model="form.apellido_paterno" type="text" placeholder="Apellido P" class="w-full p-2 border border-gray-400 rounded" />
                </div>
            </div>

            <!-- Campo Horario con selector de fecha -->
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Horario</label>
                <input v-model="form.horario" type="datetime-local" @change="formatDateTime" class="w-full p-2 border border-gray-400 rounded" />
            </div>

            <!-- Campo Ubicación -->
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Ubicación</label>
                <select v-model="form.ubicacion" class="w-full p-2 border border-gray-400 rounded">
                <option disabled value="">Seleccione...</option>
                <option>Ubicación 1</option>
                <option>Ubicación 2</option>
                <option>Ubicación 3</option>
                </select>
            </div>

            <!-- Botón de Agregar -->
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 rounded">
                Agregar
            </button>
        </form>
    </div>
</Modal>
   
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
        form: {
        rut: '',
        dv: '',
        nombre: '',
        apellido_materno: '',
        apellido_paterno: '',
        horario: '',
        ubicacion: '',
        formattedDateTime: '',
      },
      };
    },

    computed: {
      
      formattedPhone() {
            // Formatear el número de teléfono
            const cleaned = this.phoneInput.replace(/\D/g, ''); // Remover todos los caracteres no numéricos
            const match = cleaned.match(/^(\+?(\d{2}))?(\d{4})(\d{4})$/); // Coincidir con el patrón deseado
            if (match) {
                return `+${match[1] || ''} ${match[3]} ${match[4]}`; // Construir el formato
            }
            return this.phoneInput; // Retornar el valor original si no coincide
        },
    },

    methods: {
        openModal() {
            this.resetForm();
            this.showModal = true; // Abre el modal
        },
        closeModal() {
            this.showModal = false; // Cierra el modal
        },
        submitForm() {
        // Solo mostramos los datos en la consola en este ejemplo
        this.formatDateTime();
         console.log(this.form);
        },
        formatDateTime() {
            if (this.form.horario) {
                const date = new Date(this.form.horario);
                // Formato deseado: YYYY-MM-DD HH:mm
                this.form.horario = date.toISOString().slice(0, 19).replace('T', ' ');
            }
        },
        resetForm() {
          // Restablece todos los campos del formulario a valores iniciales
          this.form = {
              rut: '',
              dv: '',
              nombre: '',
              apellido_materno: '',
              apellido_paterno: '',
              horario: '',
              ubicacion: '',
          };
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