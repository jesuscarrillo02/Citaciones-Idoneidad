<script setup>
    import { Link, usePage  } from '@inertiajs/vue3';
    import modalAyudante from '@/Components/Formularios/formAyudante.vue';
</script>

<template>
  <div class="mx-auto bg-blue-900 shadow-sm sm:rounded-lg sm:px-7 lg:px-7">
    <div>
      <h1 class="font-semibold text-xl py-3 text-white  leading-tight">
        Ayudantes del instituto <strong>{{ institutionName }}</strong>
      </h1>
    </div>
    <!-- Barra de búsqueda -->
    <div class="mb-4 flex items-center">|
      <input type="text" placeholder="Buscar Ayudante..." v-model="search" @input="getAyudantesPsi"
        class="p-3 rounded-lg border-2 border-purple-500 bg-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500" />

      <Link :href="route('CitacionesPendientes')" class="ml-auto">
        <button class="rounded-md bg-blue-600 px-3 py-3 text-sm hover:bg-blue-500 font-semibold text-white">
          Ver citaciones
        </button>
      </Link>

      <modalAyudante ></modalAyudante>
    </div>

    <!-- Tabla de ayudantes -->
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
      <table class="w-full bg-white border border-black-200 rounded-lg shadow-md">
        <thead>
          <tr class="bg-gray-300 text-gray-700 uppercase text-sm leading-normal">
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
            <td class="py-3 px-3 text-left">{{ ayudante.RUT_ayu }}-{{ ayudante.DV_ayu }}</td>
            <td class="py-3 px-3 text-left">{{ ayudante.Nombre }}</td>
            <td class="py-3 px-3 text-left">{{ ayudante.Apellido_M }}</td>
            <td class="py-3 px-3 text-left">{{ ayudante.Apellido_P }}</td>
            <td class="py-3 px-6 text-left">{{ ayudante.Correo_ayu }}</td>
            <td class="py-3 px-3 text-left">{{ ayudante.Telefono_ayu }}</td>
            <td class="py-3 px-3 text-center">
              <span :class="ayudante.Estado_ayudante ? 'bg-green-200 text-green-700' : 'bg-red-200 text-red-700'"
                class="py-1 px-3 rounded-full text-xs">
                {{ ayudante.Estado_ayudante ? 'Activo' : 'Inactivo' }}
              </span> 
            </td>
            <td class="py-3 px-2 text-center">
              <button title="Editar ayudante" class="px-2 text-yellow-600 hover:text-yellow-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" viewBox="0 0 24 24"><path fill="currentColor" d="M5 18h4.24a1 1 0 0 0 .71-.29l6.92-6.93L19.71 8a1 1 0 0 0 0-1.42l-4.24-4.29a1 1 0 0 0-1.42 0l-2.82 2.83l-6.94 6.93a1 1 0 0 0-.29.71V17a1 1 0 0 0 1 1m9.76-13.59l2.83 2.83l-1.42 1.42l-2.83-2.83ZM6 13.17l5.93-5.93l2.83 2.83L8.83 16H6ZM21 20H3a1 1 0 0 0 0 2h18a1 1 0 0 0 0-2"/></svg>
                </button>
                <button :class="ayudante.Estado_ayudante ? 'text-green-700 hover:text-green-500' : 'text-red-700 hover:text-red-500'" :title="ayudante.Estado_ayudante ? 'desactivar ayudante':'activar ayudante'" class="px-1" >
                    <span v-if="ayudante.Estado_ayudante">
                        <!-- Ícono de activo -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" viewBox="0 0 24 24"><path fill="currentColor" d="M21.1 12.5l1.4 1.41l-6.53 6.59L12.5 17l1.4-1.41l2.07 2.08zM10 17l3 3H3v-2c0-2.21 3.58-4 8-4l1.89.11zm1-13a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4"/>
                        </svg>
                    </span>
                    <span v-else>
                        <!-- Ícono de inactivo -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" viewBox="0 0 24 24"><path fill="currentColor" d="M12 4a4 4 0 0 1 4 4c0 1.95-1.4 3.58-3.25 3.93L8.07 7.25A4.004 4.004 0 0 1 12 4m.28 10l6 6L20 21.72L18.73 23l-3-3H4v-2c0-1.84 2.5-3.39 5.87-3.86L2.78 7.05l1.27-1.27zM20 18v1.18l-4.86-4.86C18 14.93 20 16.35 20 18"/></svg>
                    </span>
                </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Paginación -->
    <div class="flex items-center py-4">

      <div class="flex justify-between items-center ml-auto">

        <div class="flex justify-between items-center ml-auto">
    <button @click="prevPage" :disabled="currentPage === 1"
      class="bg-blue-500 text-white px-2 py-2 rounded hover:bg-blue-600">
      Anterior
    </button>
    
    <span class="px-3 text-white">Mostrando página {{ currentPage }} de {{ totalPages }}</span>
    
    <button @click="nextPage" :disabled="currentPage === totalPages"
      class="bg-blue-500 text-white px-2 py-2 rounded hover:bg-blue-600">
      Siguiente
    </button>
  </div>

      </div>
    </div>
  </div>
  
</template>

<script>
  export default {
    name: 'Home',
    props: {
      message: String
    },
    data() {
      return {
        //showModal: false,
        currentPage : 1,
        totalPages: 1,
        search: "",
        ayudantesPsi :[],
        IDInstitucion_ayudantes: null,
        estadoTabla:1,
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

    mounted() {//ejecuta el codigo declarado en el
      const { props } = usePage();
      const IDInstitucion = props.auth.user.ID_Institucion_usuario;
      this.IDInstitucion_ayudantes =IDInstitucion;
      this.getInstituciones();
      this.getAyudantesPsi();
    },

    methods: {

      cargaTabla(){
        console.log("se entra a c.t.");
      },

      async getAyudantesPsi(currentPage = 1) {
        const response = await axios.get(`/api/Ayudantes_edu`, {
        params: {
          search: this.search,
          page: currentPage,
          IDInstitucion: this.IDInstitucion_ayudantes,
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
          institutionId: this.IDInstitucion_ayudantes
          }
        })
        .then(response => {
          this.institutionName = response.data.Nombre_inst;

        })
        .catch(error => {
          console.error('Hubo un error al obtener las instituciones:', error);
        })
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