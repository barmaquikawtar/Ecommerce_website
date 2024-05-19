using MySql.Data.MySqlClient;
using System;
using System.Data;
using System.Windows.Forms;

namespace Biblio
{
    public partial class Ouvrage : Form
    {
        MySqlConnection conn;
        string myConnectionString = "server=localhost;uid=root;pwd=;database=biblio";
        MySqlCommand cmd;
        MySqlDataReader dr;
        private int selected_id;
        public Ouvrage()
        {
            InitializeComponent();
        }

        private void Ouvrage_Load(object sender, EventArgs e)
        {
            button2.Enabled = false;
            button3.Enabled = false;
            displaydata();
        }
        private void displaydata()
        {
            try
            {
                conn = new MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();

                dataGridView3.DataSource = null;
                ////disponible ouvrage
                MySqlDataAdapter adapter3 = new MySqlDataAdapter("SELECT id,name,type,auteur,editeur,numero FROM `ouvrage`"
                 , conn);
                DataTable dt3 = new DataTable();
                adapter3.Fill(dt3);
                dataGridView3.DataSource = dt3;
                dataGridView3.Columns[0].HeaderText = "Id";
                dataGridView3.Columns[1].HeaderText = "Nom";
                dataGridView3.Columns[2].HeaderText = "Type";
                dataGridView3.Columns[3].HeaderText = "Auteur";
                dataGridView3.Columns[4].HeaderText = "Editeur";
                dataGridView3.Columns[5].HeaderText = "Numero";
                conn.Close();
            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                MessageBox.Show(ex.Message);
            }
        }
        private void createfunction()
        {
            try
            {
                conn = new MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();
                String req = "INSERT INTO `ouvrage`(`name`, `type`, `auteur`, `editeur`, `numero`) VALUES " +
                    " (@name,@type,@auteur,@editeur,@numero)";
                cmd = new MySqlCommand(req, conn);
                cmd.Parameters.AddWithValue("@name", textBox1.Text);
                cmd.Parameters.AddWithValue("@type", comboBox1.SelectedItem);
                cmd.Parameters.AddWithValue("@auteur", textBox2.Text);
                cmd.Parameters.AddWithValue("@editeur", textBox3.Text);
                cmd.Parameters.AddWithValue("@numero", textBox4.Text);
                cmd.ExecuteNonQuery();
                conn.Close();
                displaydata();
            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                MessageBox.Show(ex.Message);
            }
        }
        private void updatefunction()
        {
            try
            {
                conn = new MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();
                String req = " UPDATE `ouvrage` SET `name`=@name,`type`=@type,`auteur`=@auteur,`editeur`=@editeur,`numero`=@numero WHERE id = @id";

                cmd = new MySqlCommand(req, conn);
                if (comboBox1.SelectedItem.Equals("Livre"))
                {
                    textBox4.Clear();
                }
                else if (comboBox1.SelectedItem.Equals("Cd"))
                {
                    textBox2.Clear();
                    textBox3.Clear();
                    textBox4.Clear();
                }
                else if (comboBox1.SelectedItem.Equals("Periodique"))
                {
                    textBox2.Clear();
                    textBox3.Clear();
                }
                cmd.Parameters.AddWithValue("@name", textBox1.Text);
                cmd.Parameters.AddWithValue("@type", comboBox1.SelectedItem);
                cmd.Parameters.AddWithValue("@auteur", textBox2.Text);
                cmd.Parameters.AddWithValue("@editeur", textBox3.Text);
                cmd.Parameters.AddWithValue("@numero", textBox4.Text);
                cmd.Parameters.AddWithValue("@id", selected_id);
                cmd.ExecuteNonQuery();
                conn.Close();
                displaydata();

            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                MessageBox.Show(ex.Message);
            }
        }
        private void button1_Click(object sender, EventArgs e)
        {
            if (String.IsNullOrWhiteSpace(textBox1.Text) || comboBox1.SelectedItem.ToString() == null ||
                comboBox1.SelectedItem.ToString() == "")
            {
                errormessage.Text = "Remplir les information de l'ouvrage";
            }
            else
            {
                if (comboBox1.SelectedItem.ToString() == "Livre")
                {
                    if (String.IsNullOrWhiteSpace(textBox2.Text) || String.IsNullOrWhiteSpace(textBox3.Text))
                    {
                        errormessage.Text = "Remplir les information de l'ouvrage";
                    }
                    else
                    {
                        errormessage.Text = "";
                        createfunction();
                    }
                }
                else if (comboBox1.SelectedItem.ToString() == "Cd")
                {
                    errormessage.Text = "";
                    createfunction();
                }
                else if (comboBox1.SelectedItem.ToString() == "Periodique")
                {
                    if (String.IsNullOrWhiteSpace(textBox4.Text))
                    {
                        errormessage.Text = "Remplir les information de l'ouvrage";
                    }
                    else
                    {
                        errormessage.Text = "";
                        createfunction();
                    }
                }

            }

        }

        private void comboBox1_SelectedIndexChanged(object sender, EventArgs e)
        {
            if (comboBox1.SelectedItem.Equals("Livre"))
            {
                textBox2.ReadOnly = false;
                textBox3.ReadOnly = false;
                textBox4.ReadOnly = true;
            }
            else if (comboBox1.SelectedItem.Equals("Cd"))
            {
                textBox2.ReadOnly = true;
                textBox3.ReadOnly = true;
                textBox4.ReadOnly = true;
            }
            else if (comboBox1.SelectedItem.Equals("Periodique"))
            {
                textBox2.ReadOnly = true;
                textBox3.ReadOnly = true;
                textBox4.ReadOnly = false;
            }
        }



        private void button3_Click(object sender, EventArgs e)
        {
            if (selected_id != null)
            {
                try
                {



                    conn = new MySqlConnection();
                    conn.ConnectionString = myConnectionString;
                    conn.Open();
                    String req = " DELETE FROM `ouvrage` WHERE id = @id";

                    cmd = new MySqlCommand(req, conn);
                    cmd.Parameters.AddWithValue("@id", selected_id);
                    cmd.ExecuteNonQuery();
                    conn.Close();
                    displaydata();

                }
                catch (MySql.Data.MySqlClient.MySqlException ex)
                {
                    MessageBox.Show(ex.Message);
                }
            }
        }

        private void button2_Click(object sender, EventArgs e)
        {
            if (selected_id != null)
            {
                if (String.IsNullOrWhiteSpace(textBox1.Text) || comboBox1.SelectedItem.ToString() == null ||
              comboBox1.SelectedItem.ToString() == "")
                {
                    errormessage.Text = "Remplir les information de l'ouvrage";
                }
                else
                {
                    if (comboBox1.SelectedItem.ToString() == "Livre")
                    {
                        if (String.IsNullOrWhiteSpace(textBox2.Text) || String.IsNullOrWhiteSpace(textBox3.Text))
                        {
                            errormessage.Text = "Remplir les information de l'ouvrage";
                        }
                        else
                        {
                            errormessage.Text = "";
                            updatefunction();
                        }
                    }
                    else if (comboBox1.SelectedItem.ToString() == "Cd")
                    {
                        errormessage.Text = "";
                        updatefunction();
                    }
                    else if (comboBox1.SelectedItem.ToString() == "Periodique")
                    {
                        if (String.IsNullOrWhiteSpace(textBox4.Text))
                        {

                            errormessage.Text = "Remplir les information de l'ouvrage";
                        }
                        else
                        {
                            errormessage.Text = "";
                            updatefunction();
                        }
                    }

                }

              
            }
        }

        private void dataGridView3_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            if(dataGridView3.SelectedRows[0].Cells["Id"].Value.ToString() != "")
            {
            selected_id = int.Parse(dataGridView3.SelectedRows[0].Cells["Id"].Value.ToString());
            textBox1.Text = dataGridView3.SelectedRows[0].Cells["name"].Value.ToString();
            string selectedtype = dataGridView3.SelectedRows[0].Cells["Type"].Value.ToString();
            if (selectedtype.Equals("Livre"))
            {
                comboBox1.SelectedIndex = 0;
            }
            else if (selectedtype.Equals("Cd"))
            {
                comboBox1.SelectedIndex = 1;
            }
            else if (selectedtype.Equals("Periodique"))
            {
                comboBox1.SelectedIndex = 2;
            }
            textBox2.Text = dataGridView3.SelectedRows[0].Cells["Auteur"].Value.ToString();
            textBox3.Text = dataGridView3.SelectedRows[0].Cells["Editeur"].Value.ToString();
            textBox4.Text = dataGridView3.SelectedRows[0].Cells["Numero"].Value.ToString();

            button2.Enabled = true;
            button3.Enabled = true;
            }

        }

        private void dataGridView3_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {

        }

        private void hoToolStripMenuItem_Click(object sender, EventArgs e)
        {
            this.Hide();
            Home form = new Home();
            form.Show();

        }

        private void ouvragesToolStripMenuItem_Click(object sender, EventArgs e)
        {

        }

        private void emprintsToolStripMenuItem_Click(object sender, EventArgs e)
        {
            this.Hide();
            Emprint form = new Emprint();
            form.Show();
        }

        private void usersToolStripMenuItem_Click(object sender, EventArgs e)
        {
            this.Hide();
            Client form = new Client();
            form.Show();
        }
    }
}
