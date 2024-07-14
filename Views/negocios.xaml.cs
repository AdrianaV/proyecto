using Newtonsoft.Json;
using System.Collections.ObjectModel;

namespace proyecto.Views;

public partial class negocios : ContentPage
{
    private const string Url = "http://192.168.200.7/proyecto/usuarios.php";
    private readonly HttpClient cliente = new HttpClient();
    private ObservableCollection<Modelos.Usuario> usu;
    String usuario;

    public negocios(String user)
	{
		InitializeComponent();
        lblUsuario.Text = user;
        usuario= user;
        listar();
    }

    public async void listar()
    {
        var content = await cliente.GetStringAsync(Url);
        List<Modelos.Usuario> mostrar = JsonConvert.DeserializeObject<List<Modelos.Usuario>>(content);
        usu = new ObservableCollection<Modelos.Usuario>(mostrar);
        listaNegocios.ItemsSource = usu;
    }

    private async void btnDetalle_Clicked(object sender, EventArgs e)
    {
        if (sender is Button btn)
        {
            if (btn.BindingContext is Modelos.Usuario negocio)
            {
                // Aquí puedes navegar a otra página y pasar los detalles del negocio como parámetros
                await Navigation.PushAsync(new detalle(negocio, usuario));
            }
        }
    }
}