<script setup>
import Modal from '@/Components/Modal.vue';
import { usePage } from '@inertiajs/vue3';

</script>

<template>
<button @click="openModal"  class="flex items-center rounded-md bg-blue-600 px-3 py-3 text-sm hover:bg-blue-500 font-semibold text-white space-x-3 m-1">
  <svg xmlns="http://www.w3.org/2000/svg" width="1.2rem" height="1.5rem" viewBox="0 0 24 24">
    <path fill="currentColor" d="M12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25z"/><path fill="currentColor" fill-rule="evenodd" d="M12 1.25C6.063 1.25 1.25 6.063 1.25 12S6.063 22.75 12 22.75S22.75 17.937 22.75 12S17.937 1.25 12 1.25M2.75 12a9.25 9.25 0 1 1 18.5 0a9.25 9.25 0 0 1-18.5 0" clip-rule="evenodd"/></svg>
  Agregar ayudante
</button>

<Modal :show="showModal" @close="closeModal">
     <!--fixed inset-0 flex items-center justify-center bg-black bg-opacity-70 z-50 -->
     <div class="modal-container bg-white  w-full max-w-md p-7 py-7 rounded-lg z-50 shadow-lg relative">
          <!-- Botón de cierre -->
          <div>
            <h1 class="text-lg font-bold mb-4">Datos del ayudante</h1>
            <button @click="closeModal" class="absolute rounded-lg  top-6 right-10 text-blue-900 hover:text-red-700" title="cerrar formulario"> 
                <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 " width="1em" height="1em" viewBox="0 0 24 24" fill="2" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10m0-1.2a8.8 8.8 0 1 0 0-17.6a8.8 8.8 0 0 0 0 17.6m.849-8.8l3.11 3.111l-.848.849L12 12.849l-3.111 3.11l-.849-.848L11.151 12l-3.11-3.111l.848-.849L12 11.151l3.111-3.11l.849.848z" />
                </svg>
            </button>
            
          </div>
          
          <!-- Formulario ayudante-->
          <form class="text-black">
            <div class="bg-blue-900 text-white p-7 rounded-lg shadow-lg w-96">
              <div class="flex gap-2 mb-4">
                <div class="flex-1">
                  <label class="block mb-1">RUT</label>
                  <input type="number" v-model="rut" oninput="if (this.value.length > 8) this.value = this.value.slice(0, 8)" placeholder="ej.12345678" class="w-full p-2 border border-gray-300 rounded" />
                </div>
                <div class="w-1/4">
                  <label class="block mb-1">D.V</label>
                  <input title="Si termima en K coloque 0" type="number" v-model="dv" oninput="if (this.value.length > 1) this.value = this.value.slice(0, 1)" placeholder="9" class="w-full p-2 border border-gray-300 rounded"/>
                </div>
              </div>
              
              <div class="flex gap-2 mb-4">
                <div class="flex-1">
                  <label class="block mb-1">Nombre </label>
                  <input type="text" v-model="nombre" placeholder="Nombre" class="w-full p-2 border border-gray-300 rounded"
                  />
                </div>
                <div class="w-1/4">
                  <label class="block mb-1">Edad:</label>
                  <input type="number" v-model="edad" oninput="if (this.value.length > 2) this.value = this.value.slice(0, 2)" placeholder="Edad" class="w-full p-2 border border-gray-300 rounded"/>
                </div>
              </div>
              
              <div class="flex gap-2 mb-4">
                <div class="flex-1">
                  <label class="block mb-1">Apellido Materno</label>
                  <input type="text" v-model="apellidoMaterno" placeholder="Apellido M." class="w-full p-2 border border-gray-300 rounded"
                  />
                </div>
                <div class="flex-1">
                  <label class="block mb-1">Apellido Paterno</label>
                  <input type="text" v-model="apellidoPaterno" placeholder="Apellido P." class="w-full p-2 border border-gray-300 rounded"/>
                </div>
              </div>
              
              <div class="mb-4">
                <label class="block mb-1">Correo</label>
                <input type="email" v-model="correo" placeholder="ejemplo.@gmail.com" class="w-full p-2 border border-gray-300 rounded"/>
              </div>
              
              <!-- <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Ubicación</label>
                <select v-model="selectedInstitucion" class="w-full p-2 border text-black border-gray-300 rounded">
                  <option disabled value="">Seleccione una institución</option>
                  <option v-for="institucion in SelectInstitucione" :key="institucion.id" :value="institucion.id">
                  {{ institucion.Nombre_inst }}
                  </option>
               </select>
            </div> -->
              
              <div class="mb-4">
                <label class="block mb-1">Telefono</label>
                <input  type="tel" :value="formattedPhone"  @input="onInput" oninput="if (this.value.length > 15) this.value = this.value.slice(0, 15)"  placeholder="+56 9 1111 1111" class="w-full p-2 border border-gray-300 rounded"/>
              </div>

              <button  @click="register" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 rounded">
                Registrarse
              </button>
            </div>
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
        phoneInput: '', 
        rut: "",         // Campo de RUT
        dv: "",          // Campo de Dígito Verificador
        nombre: "",      // Campo de Nombre
        apellidoMaterno: "",  // Campo de Apellido Materno
        apellidoPaterno: "",  // Campo de Apellido Paterno
        correo: "",       // Campo de Correo Electrónico
        edad: "",  
        SelectInstitucione: [],
        selectedInstitucion: "",
      };
    },

    computed: {
      
      formattedPhone() {
            // Formatear el número de teléfono
            const cleaned = this.phoneInput.replace(/\D/g, ''); // Remover todos los caracteres no numéricos
            const match = cleaned.match(/^(\d{2})(\d{1})(\d{4})(\d{4})$/); // Coincidir con el patrón deseado
            if (match) {
                return `+${match[1]} ${match[2]} ${match[3]} ${match[4]}`; // Construir el formato
            }
            return this.phoneInput; // Retornar el valor original si no coincide
        },
    },

    methods: {

        openModal() {
          this.phoneInput = "";
          this.rut = "";
          this.dv = "";
          this.nombre = "";
          this.apellidoMaterno = "";
          this.apellidoPaterno = "";
          this.correo = "";
          this.edad = "";
          this.showModal = true; // Abre el modal
          this.selectedInstitucion ='';
        },
        closeModal() {
            this.showModal = false; // Cierra el modal
        },

        verificarRegistro(){

        },

        async register() {
          const { props } = usePage();
          const IDInstitucion = props.auth.user.ID_Institucion_usuario;
          this.selectedInstitucion =IDInstitucion;

          const cleanedPhone = parseInt(this.phoneInput.replace(/\D/g, '')); // Elimina caracteres no numéricos
          this.phoneInput =cleanedPhone;

           try {
              const response = await axios.post('/api/CreateAyudantes', {
                Nombre: this.nombre,
                Apellido_M: this.apellidoMaterno,
                Apellido_P: this.apellidoPaterno,
                Edad: this.edad,
                RUT_ayu: this.rut,
                DV_ayu: this.dv,
                Telefono_ayu: this.phoneInput,
                Correo_ayu: this.correo,
                Estado_ayudante: 1,
                ID_Institucion_ayu: this.selectedInstitucion,
              });
                //console.log(response.data.message);
                alert("Se a creado un nuevo registrado correctamente");
            } catch (error) {
                console.error('Error al registrar ayudante:', error);
            }
          
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