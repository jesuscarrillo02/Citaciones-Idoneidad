<script setup>
    import { Link, usePage } from '@inertiajs/vue3';
    import Modal from '@/Components/Modal.vue';
</script>

<template>
  <div class="mx-auto bg-blue-900 shadow-sm sm:rounded-lg sm:px-7 lg:px-7">
    <div>
      <h1 class="font-semibold text-xl py-3 text-gray-800 dark:text-gray-200 leading-tight">
         Ayudantes del instituto <strong>{{ institutionName }}</strong>
      </h1>
    </div>
    <!-- Barra de búsqueda -->
    <div class="mb-4 flex items-center">
      <input type="text" placeholder="Buscar Ayudante..." v-model="search" @input="getAyudantesPsi"
        class="p-3 rounded-lg border-2 border-purple-500 bg-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500" />
      
      <Link :href="route('Citacion_Psi',{ institu_pert: institutionId })" class="ml-auto">
        <button class="rounded-md bg-blue-600 px-3 py-3 text-sm hover:bg-blue-500 font-semibold text-white">
          Ver citaciones
        </button>
      </Link>
    </div>

    <!-- Tabla de ayudantes -->
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
      <table class="w-full bg-white border border-black-200 rounded-lg shadow-md">
        <thead>
          <tr class="bg-gray-300 text-gray-700 uppercase text-sm leading-normal">
            <th class="py-3 px-3 text-left">ID</th>
            <th class="py-3 px-3 text-left">R.U.T</th>
            <th class="py-3 px-3 text-left">Nombre</th>
            <th class="py-3 px-3 text-left">Apellido M.</th>
            <th class="py-3 px-3 text-left">Apellido P.</th>
            <th class="py-3 px-6 text-left">Email</th>
            <th class="py-3 px-3 text-left">Teléfono</th>
            <th class="py-3 px-3 text-center">Estado</th>
            <th class="py-3 px-3 text-center">Acción</th>
          </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
          <tr v-if="ayudantesPsi.data && ayudantesPsi.data.length === 0" class="border-b border-gray-200 hover:bg-gray-100 ">
                <td colspan="8" class="py-3 px-3 text-center text-gray-900 ">
                  <h1>No se encontró ningún registro</h1>
                </td>
              </tr>

          <tr v-for="ayudante in ayudantesPsi.data" :key="ayudante.id" class="border-b border-gray-200 hover:bg-gray-100">
            <td class="py-3 px-3 text-left">{{ ayudante.id }}</td>
            <td class="py-3 px-3 text-left">{{ ayudante.RUT_ayu }}-{{ ayudante.DV_ayu }}</td>
            <td class="py-3 px-3 text-left">{{ ayudante.Nombre }}</td>
            <td class="py-3 px-3 text-left">{{ ayudante.Apellido_M }}</td>
            <td class="py-3 px-3 text-left">{{ ayudante.Apellido_P }}</td>
            <td class="py-3 px-6 text-left">{{ ayudante.Correo_ayu }}</td>
            <td class="py-3 px-3 text-left">+{{ ayudante.Telefono_ayu }}</td>
            <td class="py-3 px-3 text-center">
              <span :class="ayudante.Estado_ayudante ? 'bg-green-200 text-green-700' : 'bg-red-200 text-red-700'"
                class="py-1 px-3 rounded-full text-xs">
                {{ ayudante.Estado_ayudante ? 'Activo' : 'Inactivo' }}
              </span> 
            </td>
            <td class="py-3 px-2 text-center">
              <span v-if="ayudante.Estado_ayudante">
                <button @click="openModal(ayudante)" class="rounded-md bg-blue-600 px-3 py-2 text-sm hover:bg-blue-500 font-semibold text-white space-x-3 m-1">Citar</button>
   
              </span>
              <span v-else>
                <button :disabled="true" @click="openModal(ayudante)" class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white space-x-3 m-1">Citar</button>
              </span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Paginación -->
    <div class="flex items-center py-4">
      <Link :href="route('Inst_edu')">
        <button class="rounded-md bg-blue-600 px-6 py-3 text-sm hover:bg-blue-500 font-semibold text-white">
          Volver
        </button>
      </Link>

      <div class="flex justify-between items-center ml-auto">

        <div class="flex justify-between items-center ml-auto">
    <button @click="prevPage" :disabled="currentPage === 1"
      class="bg-blue-500 text-white px-2 py-2 rounded hover:bg-blue-600">
      Anterior
    </button>
    
    <span class="px-3 text-white"> página {{ currentPage }} de {{ totalPages }}</span>
    
    <button @click="nextPage" :disabled="currentPage === totalPages"
      class="bg-blue-500 text-white px-2 py-2 rounded hover:bg-blue-600">
      Siguiente
    </button>
  </div>

      </div>
    </div>
  </div>
  
  <!--  Modal citaciones -->
  <Modal :show="showModal" @close="closeModal"  >
    <div class="modal-container bg-white  w-full max-w-md p-6 rounded-lg z-50 shadow-lg relative">

        <!-- Botón de cierre -->
        <div>
            <h1 class="text-lg font-bold mb-4">Citacion </h1>
            <button @click="closeModal" class="absolute rounded-lg  top-6 right-10 text-blue-900 hover:text-red-700" title="cerrar formulario"> 
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" width="1em" height="1em" viewBox="0 0 24 24" fill="2" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10m0-1.2a8.8 8.8 0 1 0 0-17.6a8.8 8.8 0 0 0 0 17.6m.849-8.8l3.11 3.111l-.848.849L12 12.849l-3.111 3.11l-.849-.848L11.151 12l-3.11-3.111l.848-.849L12 11.151l3.111-3.11l.849.848z" />
                </svg>
            </button>
        </div>
          
        <!-- Formulario para citar-->
        <form @submit.prevent="submitForm" :datos="datosSeleccionados" class="text-black">
        <!-- Campo RUT -->
            <div class="flex gap-2 mb-4">
                <div class="flex-1">
                    <label  class="block mb-1">RUT</label>
                    <input  :disabled="true"  v-model="rut" type="number" oninput="if (this.value.length > 8) this.value = this.value.slice(0, 8)" placeholder="ej.12345678" class="w-full bg-gray-300 p-2 border border-gray-300 rounded" />
                </div>
                <div class="w-1/4">
                    <label class="block mb-1">D.V</label>
                    <input :disabled="true" v-model="dv" type="number" oninput="if (this.value.length > 1) this.value = this.value.slice(0, 1)" placeholder="9" class="w-full bg-gray-300 p-2 border border-gray-300 rounded"/>
                </div>
                <div class="w-1/4">
                    <label class="block mb-1">ID</label>
                    <input :disabled="true" v-model="id" type="number" oninput="if (this.value.length > 1) this.value = this.value.slice(0, 1)" placeholder="9" class="w-full bg-gray-300 p-2 border border-gray-300 rounded"/>
                </div>
            </div>

            <!-- Campo Nombre del ayudante -->
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Nombre del ayudante</label>
                <input :disabled="true" v-model="nombre" type="text" placeholder="Nombre del ayudante" class="w-full bg-gray-300 p-2 border border-gray-400 rounded" />
            </div>

            <!-- Campos Apellido M y Apellido P -->
            <div class="flex space-x-4 mb-4">
                <div class="flex-1">
                <label class="block text-sm font-bold mb-2">Apellido M</label>
                <input :disabled="true" v-model="apellido_materno" type="text" placeholder="Apellido M" class="w-full p-2 border border-gray-400 bg-gray-300 rounded" />
                </div>
                <div class="flex-1">
                <label class="block text-sm font-bold mb-2">Apellido P</label>
                <input :disabled="true" v-model="apellido_paterno" type="text" placeholder="Apellido P" class="w-full p-2 border border-gray-400 bg-gray-300 rounded" />
                </div>
            </div>

            <!-- Campo Horario con selector de fecha -->
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Horario</label>
                <input v-model="horario" type="date"  class="w-full p-2 border border-gray-400 rounded" />
            </div>

            <!-- Campo Ubicación -->
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Ubicación</label>
                <select v-model="ubicacion" class="w-full p-2 border border-gray-400 rounded">
                <option disabled value="">Seleccione...</option>
                <option value="Servicio de salud Araucania Sur">Servicio de salud Araucania Sur</option>
                <option value="Servicio de salud Araucania Norte">Servicio de salud Araucania Norte</option>
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
      message: String,
      show: Boolean,
      onClose: Function,
      datos: {
        type: Object,
        default: () => ({})
      }
      
    },
    data() {
      return {
        //showModal: false,
        currentPage : 1,
        totalPages: 1,
        search: "",
        ayudantesPsi :[],
        institutionId: '',
        showModal: false,
        datosSeleccionados:{},
        rut: '',
        dv: '',
        id:'',
        idAyudante: '',
        nombre: '',
        apellido_materno: '',
        apellido_paterno: '',
        ID_Usuario_encargado:'',
        horario: '',
        ubicacion: '',
        formattedDateTime: '',
        institutionName: "",
      };
    },

    computed: {
        filterAyudantesPsi() {
        return this.ayudantesPsi.filter((ayudantes) =>
        ayudantes.Nombre.toLowerCase().includes(this.search.toLowerCase())
        );
      },
    },
    

    mounted() {
      const { props } = usePage();
      const IDPsicologo = props.auth.user.id;
      this.ID_Usuario_encargado = IDPsicologo ;
      // Obtén el ID de la institución desde los parámetros de la URL
      const urlParams = new URLSearchParams(window.location.search);
      this.institutionId = urlParams.get('institutionId');
      this.getAyudantesPsi();
      this.getInstituciones();
    },

    methods: {
      async getAyudantesPsi(currentPage = 1) {
        const response = await axios.get(`/api/Ayudantes_psi`, {
        params: {
          search: this.search,
          page: currentPage,
          institutionId: this.institutionId
          }
        })
        .then(response => {
          this.ayudantesPsi = response.data;  // Asignar los datos a la variable
          this.currentPage = response.data.current_page;
          this.totalPages = response.data.last_page;
        })
        .catch(error => {
          console.error('Hubo un error al obtener las instituciones:', error);
        });
      },

      //obtener institucion
      async getInstituciones() {
        const response = await axios.get(`/api/ListaInstitucionesActual`, {
        params: {
          institutionId: this.institutionId
          }
        })
        .then(response => {
          this.institutionName = response.data.Nombre_inst;
        })
        .catch(error => {
          console.error('Hubo un error al obtener las instituciones:', error);
        });
      },

      prevPage() {
      if (this.currentPage > 1) {
        this.getAyudantesPsi(this.currentPage - 1);
        }
      },

      nextPage() {
        if (this.currentPage < this.totalPages) {
          this.getAyudantesPsi(this.currentPage + 1);
        }
      },

      openModal(ayudante) {
            this.rut = ayudante.RUT_ayu,
            this.dv = ayudante.DV_ayu,
            this.idAyudante = ayudante.id,
            this.nombre= ayudante.Nombre,
            this.apellido_materno = ayudante.Apellido_M,
            this.apellido_paterno = ayudante.Apellido_P,
            this.horario = '', 
            this.ubicacion = '', 
            this.formattedDateTime = '',
            this.showModal = true; // Abre el modal
        },
        closeModal() {
            this.showModal = false; // Cierra el modal
        },

        submitForm() {
          
          axios.post(`/api/CreateCitacion`, {
              ID_Usuario_encargado: this.ID_Usuario_encargado,
              ID_institucion_asociada: this.institutionId,
              ID_Ayudante_citado:  this.idAyudante,
              Fecha_citacion: this.horario,
              Ubicacion_cita: this.ubicacion,
              Estado_citacion: 1,
          })
          .then(response => {
          console.log('Citacion registrada exitosamente', response.data);
          })
          .catch(error => {
            console.error('Hubo un error al Enviar lso datos:', error);
          });
          
          this.closeModal()
        },
        
        formatDateTime() {
            if (this.form.horario) {
                const date = new Date(this.form.horario);
                // Formato deseado: YYYY-MM-DD HH:mm
                this.form.horario = date.toISOString().split('T')[0];
            }
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