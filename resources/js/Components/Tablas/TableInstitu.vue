<script setup>
    import { Link } from '@inertiajs/vue3';
</script>

<template>
   <!-- Search Input -->

   <div>
    
   </div>
   <div class="mb-4 ">
        <input type="text" placeholder="Buscar instituto..." 
        class="p-3 rounded-lg border-2 border-purple-500 bg-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500"
        v-model="search"/>
    </div>
   
    <!-- Institution List -->
    <div v-if="filteredInstituciones.length > 0">
      <div v-for="institucion in filteredInstituciones" :key="institucion.id" class="bg-white rounded-lg shadow-md mb-4 p-4">
        <div class="flex justify-between items-center">
          <!-- Institution Info -->
          <div class="flex space-x-4">
            <span v-for="(field, index) in institutionFields" :key="index" :class="field.bgColor"
              class="text-white py-2 px-4 rounded-md shadow-md">
              {{ institucion[field.key] }}
            </span>
          </div>

          <!-- Review Button -->
          <Link :href="route('AyudantesPsi', { institutionId: institucion.id })">
            <button class="bg-blue-900 text-white py-2 px-4 rounded-md shadow-md hover:bg-blue-800">
              Revisar institución
            </button>
          </Link>
        </div>
      </div>
    </div>
    <!-- Mensaje cuando no hay resultados -->
    <div v-else class="bg-white rounded-lg shadow-md mb-4 p-4">
      <p class=" text-center">No se encontraron instituciones que coincidan con tu búsqueda.</p>
    </div>
</template>

<script>
  export default {
    name: 'instituciones',
    props: {
      message: String
    },
    data() {
      return {
        showModal: false,
        search: '',
        phoneInput: '',
        instituciones: [],
        institutionFields: [
        { key: 'nombre', bgColor: 'bg-blue-700' },
        { key: 'direccion', bgColor: 'bg-blue-900' },
        { key: 'comuna', bgColor: 'bg-blue-500' },
      ],
      };
    },

    mounted() {//ejecuta el codigo declarado en el, pero de
      this.getInstituciones();
    },

    methods: {
      // Función para obtener las instituciones desde la API
      async getInstituciones() {
        const response = await axios.get(`/api/instituciones`, {
        params: {
          search: this.search,
          }
        })
        .then(response => {
          this.instituciones = response.data.map(inst => ({
            id: inst.id,
            nombre: inst.Nombre_inst,
            direccion: inst.Direccion,
            comuna: inst.Comuna,
          }));  // Asignar los datos a la variable
        })
        .catch(error => {
          console.error('Hubo un error al obtener las instituciones:', error);
        });
      }
    }, 

    computed: {
    filteredInstituciones() {
        return this.instituciones.filter((institucion) =>
          institucion.nombre.toLowerCase().includes(this.search.toLowerCase())
        );
      },
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