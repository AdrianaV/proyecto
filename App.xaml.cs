using proyecto.Views;

namespace proyecto
{
    public partial class App : Application
    {
        public App()
        {
            InitializeComponent();

            MainPage = new NavigationPage(new principal());

        }
    }
}
